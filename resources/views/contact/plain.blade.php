@extends('_layouts.plain')

@section('content')
<table border="1">
    <thead>
        <tr>
            <th width="5%">No.</th>
            <th width="25%">Nama</th>
            <th width="10%">Ponsel</th>
            <th width="35%">Keterangan</th>
            <th width="25%">Group</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1 ?>
        @forelse($contact_all as $contact)
        <tr>
            <td align="center">{{ $nomor++ }}</td>
                <td>{{ $contact->nama }}</td>
                <td>{{ $contact->ponsel }}</td>
                <td>{{ $contact->keterangan }}</td>
                <td>
                    @foreach($contact->group as $group)
                    {{ $group->nama }}, 
                    @endforeach
                </td>
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
    Menampilkan {{ $contact_all->count() }} data <br>
    <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
</p>
@stop