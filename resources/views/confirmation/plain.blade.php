@extends('_layouts.plain')

@section('content')
<table border="1">
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
            <th width="10%">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1 ?>
        @forelse($confirmation_all as $confirmation)
        <tr>
                <td>{{ $nomor++ }}</td>
                <td>{{ date('d/m/Y H:i:s', strtotime($confirmation->tanggal)) }}</td>
                <td>{{ $confirmation->ponsel }}</td>
                <td>{{ $confirmation->santri }}</td>
                <td>{{ $confirmation->kelas }}</td>
                <td>{{ $confirmation->jumlah }}</td>
                <td>{{ $confirmation->tanggal_kirim }}</td>
                <td>{{ $confirmation->pengirim }}</td>
                <td>{{ $confirmation->keperluan }}</td>
                <td>{{ $confirmation->status }}</td>
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
    Menampilkan {{ $confirmation_all->count() }} data <br>
    <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
</p>
@stop