@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Pembayaran <small>SOSIS</small></h1>

@include('confirmation._partials.filter')

{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'confirmation.action.multiple']) !!}
@include('confirmation._partials.action')

<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="8%">Tanggal</th>
                <th width="8%">Ponsel</th>
                <th width="15%">Santri</th>
                <th width="4%">Kelas</th>
                <th width="8%">Jumlah</th>
                <th width="12%">Dikirim</th>
                <th width="15%">Pengirim</th>
                <th width="15%">Keperluan</th>
                <th width="5%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $confirmation_all->firstItem() ?>
            @forelse($confirmation_all as $confirmation)
            <tr>
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                    {!! Form::checkbox('check[]', $confirmation->id) !!}
                    {{ $nomor++ }}.
                </td>
                <td><small>{{ date('d M Y H:i:s', strtotime($confirmation->tanggal)) }}</small></td>
                <td><small>{{ $confirmation->ponsel }}</small></td>
                <td>{{ $confirmation->santri }}</td>
                <td>{{ $confirmation->kelas }}</td>
                <td>{{ $confirmation->jumlah }}</td>
                <td><small>{{ $confirmation->tanggal_kirim }}</small></td>
                <td>{{ $confirmation->pengirim }}</td>
                <td>{{ $confirmation->keperluan }}</td>
                <td>
                    @if($confirmation->status == 'Belum')
                    <span class="label label-danger">{{ $confirmation->status }}</span>
                    @elseif($confirmation->status == 'Sudah')
                    <span class="label label-success">{{ $confirmation->status }}</span>
                    @elseif($confirmation->status == 'Tunda')
                    <span class="label label-warning">{{ $confirmation->status }}</span>
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
                            <li><a href="{{ route('confirmation.status', [$confirmation->id, 'Sudah']) }}">Verifikasi</a></li>
                            <li><a href="{{ route('confirmation.status', [$confirmation->id, 'Tunda']) }}">Tunda</a></li>
                            <li><a href="{{ route('confirmation.status', [$confirmation->id, 'Belum']) }}">Belum</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('confirmation.delete', [$confirmation->id]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
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
    {!! $confirmation_all->setPath('')->setPath('')->appends(compact('sort', 'mode', 'status', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $confirmation_all->count() }} dari total {{ $confirmation_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}' dengan status '{{ $status }}'</small>
    </p>
</div>

{!! Form::close() !!}
{{-- Akhir form multiple delete --}}

@stop