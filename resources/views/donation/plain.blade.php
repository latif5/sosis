@extends('_layouts.plain')

@section('content')
<table border="1">
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
            <th width="10%">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1 ?>
        @forelse($donation_all as $donation)
        <tr>
                <td>{{ $nomor++ }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($donation->tanggal)) }}</td>
                <td>{{ $donation->ponsel }}</td>
                <td>{{ $donation->jumlah }}</td>
                <td>{{ $donation->tanggal_kirim }}</td>
                <td>{{ $donation->pengirim }}</td>
                <td>{{ $donation->keperluan }}</td>
                <td>{{ $donation->keterangan }}</td>
                <td>{{ $donation->status }}</td>
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
    Menampilkan {{ $donation_all->count() }} data <br>
    <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
</p>
@stop