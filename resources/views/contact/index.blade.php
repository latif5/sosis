@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kontak <small>SOSIS</small></h1>

@include('contact._partials.filter')


{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'contact.delete.multiple']) !!}
<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="7%">No.</th>
                <th width="15%">Nama</th>
                <th width="15%">Nomor</th>
                <th width="33%">Keterangan</th>
                <th width="25%">Group</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $contact_all->firstItem() ?>
            @forelse($contact_all as $contact)
            <tr>
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                    {!! Form::checkbox('check[]', $contact->id) !!}
                    {{ $nomor++ }}.
                </td>
                <td>{{ $contact->nama }}</td>
                <td>{{ $contact->ponsel }}</td>
                <td>{{ $contact->keterangan }}</td>
                <td>
                    @foreach($contact->group as $group)
                    <span class="label label-default">{{ $group->nama }}</span>
                    @endforeach
                </td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="{{ route('contact.edit', [$contact->id]) }}"><span class="glyphicon glyphicon-edit"></span> Ubah</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('contact.delete', [$contact->id]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <p>Tidak ada data yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $contact_all->setPath('')->appends(compact('sort', 'mode', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $contact_all->count() }} dari total {{ $contact_all->total() }} data <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
    </p>
</div>
{{-- Tombol multiple delete --}}
<button type="submit" class="btn btn-danger">
    <span class="glyphicon glyphicon-trash"></span> 
    Hapus item terpilih
</button>
{!! Form::close() !!}
{{-- Akhir form multiple delete --}}

@stop