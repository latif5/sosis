@extends('_layouts.plain')

@section('content')
<table border="1">
    <thead>
        <tr>
            <th width="5%">No.</th>
            <th width="15%">Tanggal</th>
            <th width="10%">Pengirim</th>
            <th width="15%">Nama</th>
            <th width="50%">Isi Pesan</th>
            <th width="5%">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1 ?>
        @forelse($sentitem_all as $sentitem)
        <tr>
            <td align="center">{{ $nomor++ }}</td>
            <td align="center">{{ date('d/m/Y H:i:s', strtotime($sentitem->SendingDateTime)) }}</td>
            <td align="center">{{ $sentitem->DestinationNumber }}</td>
            <td align="center">{{ $sentitem->nama }}</td>
            <td>{{ $sentitem->TextDecoded }}</td>
            <td align="center">{{ $sentitem->Status }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6">
                <p>Tidak ada pesan yang dapat ditampilkan.</p>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
<p>
    Menampilkan {{ $sentitem_all->count() }} pesan <br>
    <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
</p>
@stop