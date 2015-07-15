@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Pembayaran <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-sort"></span> 
                Urutkan
            </button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('confirmation.index') }}?sort=tanggal&mode={{ $mode }}&status={{ $status }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Tanggal</a></li>
                <li><a href="{{ route('confirmation.index') }}?sort=status&mode={{ $mode }}&status={{ $status }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Status</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-sort-by-alphabet"></span> 
                Mode
            </button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('confirmation.index') }}?sort={{ $sort }}&mode=asc&status={{ $status }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Asc</a></li>
                <li><a href="{{ route('confirmation.index') }}?sort={{ $sort }}&mode=desc&status={{ $status }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Desc</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-flag"></span> Status</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('confirmation.index') }}?sort={{ $sort }}&mode=asc&status=&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">All</a></li>
                <li><a href="{{ route('confirmation.index') }}?sort={{ $sort }}&mode=desc&status=Belum&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Belum</a></li>
                <li><a href="{{ route('confirmation.index') }}?sort={{ $sort }}&mode=desc&status=Sudah&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Sudah</a></li>
                <li><a href="{{ route('confirmation.index') }}?sort={{ $sort }}&mode=desc&status=Tunda&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Tunda</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-export"></span> Ekspor</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" target="_blank">PDF</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        {!! Form::open(['method' => 'get', 'class' => 'form-inline pull-right']) !!}
                {!! Form::hidden('sort', $sort) !!}
                {!! Form::hidden('mode', $mode) !!}
                {!! Form::hidden('status', $status) !!}
            <div class="form-group">
                {!! Form::text('cari', $cari, ['id' => 'search', 'class' => 'form-control input-sm', 'placeholder' => 'Pencarian...']) !!}
                {!! Form::text('cari_bulan', $cari_bulan, ['id' => 'cari_bulan', 'class' => 'form-control input-sm datepicker-month', 'placeholder' => 'Bulan']) !!}
            </div>
            <button type="submit" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-search"></span>
                Cari
            </button>
        {!! Form::close() !!}
    </div>
</div><br>

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
                <td>{{ $nomor++ }}.</td>
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
                            <li><a href="{{ route('confirmation.delete', [$confirmation->id]) }}"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
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
    {!! $confirmation_all->appends(compact('sort', 'mode', 'status', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $confirmation_all->count() }} dari total {{ $confirmation_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}' dengan status '{{ $status }}'</small>
    </p>
</div>


@stop