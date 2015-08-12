@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Donasi <small>SOSIS</small></h1>

@include('donation._partials.filter')

{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'donation.action.multiple']) !!}
@include('donation._partials.action')

<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="8%">Tanggal</th>
                <th width="8%">Ponsel</th>
                <th width="8%">Jumlah</th>
                <th width="12%">Dikirim</th>
                <th width="19%">Pengirim</th>
                <th width="15%">Keperluan</th>
                <th width="15%">Keterangan</th>
                <th width="5%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $donation_all->firstItem() ?>
            @forelse($donation_all as $donation)
            <tr>
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                    {!! Form::checkbox('check[]', $donation->id) !!}
                    {{ $nomor++ }}.
                </td>
                <td><small>{{ date('d M Y H:i:s', strtotime($donation->tanggal)) }}</small></td>
                <td><small>{{ $donation->ponsel }}</small></td>
                <td>{{ $donation->jumlah }}</td>
                <td><small>{{ $donation->tanggal_kirim }}</small></td>
                <td>{{ $donation->pengirim }}</td>
                <td>{{ $donation->keperluan }}</td>
                <td>{{ $donation->keterangan }}</td>
                <td>
                    @if($donation->status == 'Belum')
                    <span class="label label-danger">{{ $donation->status }}</span>
                    @elseif($donation->status == 'Sudah')
                    <span class="label label-success">{{ $donation->status }}</span>
                    @elseif($donation->status == 'Tunda')
                    <span class="label label-warning">{{ $donation->status }}</span>
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
                            <li><a href="{{ route('donation.status', [$donation->id, 'Sudah']) }}">Verifikasi</a></li>
                            <li><a href="{{ route('donation.status', [$donation->id, 'Tunda']) }}">Tunda</a></li>
                            <li><a href="{{ route('donation.status', [$donation->id, 'Belum']) }}">Belum</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('donation.delete', [$donation->id]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10">
                    <p>Tidak ada data yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $donation_all->setPath('')->appends(compact('sort', 'mode', 'status', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $donation_all->count() }} dari total {{ $donation_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}' dengan status '{{ $status }}'</small>
    </p>
</div>

{!! Form::close() !!}
{{-- Akhir form multiple delete --}}

@stop