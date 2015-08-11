@extends('_layouts.plain')

@section('content')
<table border="1">
    <thead>
        <tr>
            <th width="5%">No.</th>
            <th width="30%">Nama</th>
            <th width="50%">Keterangan</th>
            <th width="15%">Jumlah Anggota</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1 ?>
        @forelse($group_all as $group)
        <tr>
            <td align="center">{{ $nomor++ }}</td>
                <td>{{ $group->nama }}</td>
                <td>{{ $group->keterangan }}</td>
                <td>{{ $group->contact->count() }}</td>
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
    Menampilkan {{ $group_all->count() }} data <br>
    <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
</p>
@stop