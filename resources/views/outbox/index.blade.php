@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kotak Keluar <small>SOSIS</small></h1>

@include('outbox._partials.filter')

{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'outbox.delete.multiple']) !!}
<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="15%">Tanggal</th>
                <th width="10%">Tujuan</th>
                <th width="58%">Isi Pesan</th>
                <th width="7%">Jenis</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $outbox_all->firstItem() ?>
            @forelse($outbox_all as $outbox)
            <tr>
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                        {!! Form::checkbox('check[]', $outbox->ID) !!}
                        {{ $nomor++ }}.
                </td>
                <td>
                    <small>{{ date('d M Y H:i:s', strtotime($outbox->UpdatedInDB)) }}</small>
                    <br>
                    <small class="text-muted">
                        {{ $outbox->SendingDateTime != '0000-00-00 00:00:00' ? 'dijadwalkan '.\Carbon\Carbon::parse($outbox->SendingDateTime)->diffForHumans() : 'dikirim '.\Carbon\Carbon::parse($outbox->UpdatedInDB)->diffForHumans() }}
                    </small>
                </td>
                <td>
                    <small>{{ $outbox->DestinationNumber }}</small>
                    <br>
                    <small>{{ $outbox->nama }}</small>
                </td>
                <td>{{ $outbox->TextDecoded }}</td>
                <td>
                {!! $outbox->Class == '-1' ? '<span class="label label-default">biasa</span>' : '<span class="label label-primary">flash</span>' !!}
                </td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#" data-toggle="modal" data-target="#modalDetil{{ $outbox->ID }}"><span class="glyphicon glyphicon-eye-open"></span> Detail</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('outbox.delete', [$outbox->ID]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-ban-circle"></span> Batalkan</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @include('outbox._partials.modal_detil')
            @empty
            <tr>
                <td colspan="7">
                    <p>Tidak ada pesan yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $outbox_all->setPath('')->appends(compact('sort', 'mode', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $outbox_all->count() }} dari total {{ $outbox_all->total() }} pesan <br>
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