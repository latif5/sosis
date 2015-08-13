@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Pembayaran <small>SOSIS</small></h1>

@include('psb._partials.filter')

{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'psb.action.multiple']) !!}
@include('psb._partials.action')

<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="8%">Tanggal</th>
                <th width="8%">Ponsel</th>
                <th width="15%">Santri</th>
                <th width="4%">No. Pendf.</th>
                <th width="8%">Jumlah</th>
                <th width="12%">Dikirim</th>
                <th width="15%">Pengirim</th>
                <th width="15%">Keperluan</th>
                <th width="5%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $psb_all->firstItem() ?>
            @forelse($psb_all as $psb)
            <tr>
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                    {!! Form::checkbox('check[]', $psb->id) !!}
                    {{ $nomor++ }}.
                </td>
                <td><small>{{ date('d M Y H:i:s', strtotime($psb->tanggal)) }}</small></td>
                <td><small>{{ $psb->ponsel }}</small></td>
                <td>{{ $psb->santri }}</td>
                <td>{{ $psb->no_pendaftaran }}</td>
                <td>{{ $psb->jumlah }}</td>
                <td><small>{{ $psb->tanggal_kirim }}</small></td>
                <td>{{ $psb->pengirim }}</td>
                <td>{{ $psb->keperluan }}</td>
                <td>
                    @if($psb->status == 'Belum')
                    <span class="label label-danger">{{ $psb->status }}</span>
                    @elseif($psb->status == 'Sudah')
                    <span class="label label-success">{{ $psb->status }}</span>
                    @elseif($psb->status == 'Tunda')
                    <span class="label label-warning">{{ $psb->status }}</span>
                    @endif
                </td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href=""><span class="glyphicon glyphicon-send"></span> Kirim Pesan</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('psb.status', [$psb->id, 'Sudah']) }}">Verifikasi</a></li>
                            <li><a href="{{ route('psb.status', [$psb->id, 'Tunda']) }}">Tunda</a></li>
                            <li><a href="{{ route('psb.status', [$psb->id, 'Belum']) }}">Belum</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('psb.delete', [$psb->id]) }}" data-toggle="psb"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11">
                    <p>Tidak ada data yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $psb_all->setPath('')->setPath('')->appends(compact('sort', 'mode', 'status', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $psb_all->count() }} dari total {{ $psb_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}' dengan status '{{ $status }}'</small>
    </p>
</div>

{!! Form::close() !!}
{{-- Akhir form multiple delete --}}

@stop