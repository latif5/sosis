@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Grup <small>SOSIS</small></h1>

@include('group._partials.filter')

{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'group.delete.multiple']) !!}
<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="35%">Nama</th>
                <th width="45%">Keterangan</th>
                <th width="10%">Anggota</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $group_all->firstItem() ?>
            @forelse($group_all as $group)
            <tr>
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                    {!! Form::checkbox('check[]', $group->id) !!}
                    {{ $nomor++ }}.
                </td>
                <td>{{ $group->nama }}</td>
                <td>{{ $group->keterangan }}</td>
                <td>
                    <span class="label label-default">{{ $group->contact->count() }} orang</span>
                </td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="{{ route('group.edit', [$group->id]) }}"><span class="glyphicon glyphicon-edit"></span> Ubah</a></li>
                            <li><a href="{{ route('group.member.edit', [$group->id]) }}"><span class="glyphicon glyphicon-list"></span> Anggota</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('group.delete', [$group->id]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <p>Tidak ada data yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $group_all->setPath('')->appends(compact('sort', 'mode', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $group_all->count() }} dari total {{ $group_all->total() }} data <br>
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