@extends('_layouts.plain')

@section('content')
<table border="1">
    <thead>
        <tr>
            <th width="5%">No.</th>
            <th width="8%">Tanggal</th>
            <th width="8%">Ponsel</th>
            <th width="15%">Santri</th>
            <th width="1%">Jenjang</th>
            <th width="4%">No. Pendf.</th>
            <th width="8%">Jumlah</th>
            <th width="11%">Dikirim</th>
            <th width="15%">Pengirim</th>
            <th width="15%">Keperluan</th>
            <th width="10%">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1 ?>
        @forelse($psb_all as $psb)
        <tr>
                <td>{{ $nomor++ }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($psb->tanggal)) }}</td>
                <td>{{ $psb->ponsel }}</td>
                <td>{{ $psb->santri }}</td>
                <td>{{ $psb->jenjang }}</td>
                <td>{{ $psb->no_pendaftaran }}</td>
                <td>{{ $psb->jumlah }}</td>
                <td>{{ $psb->tanggal_kirim }}</td>
                <td>{{ $psb->pengirim }}</td>
                <td>{{ $psb->keperluan }}</td>
                <td>{{ $psb->status }}</td>
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
<p>
    Menampilkan {{ $psb_all->count() }} data <br>
    <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
</p>
@stop