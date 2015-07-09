@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Donasi <small>SOSIS</small></h1>

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
                <li><a href="{{ route('donation.index') }}?sort=tanggal&mode={{ $mode }}&status={{ $status }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Tanggal</a></li>
                <li><a href="{{ route('donation.index') }}?sort=status&mode={{ $mode }}&status={{ $status }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Status</a></li>
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
                <li><a href="{{ route('donation.index') }}?sort={{ $sort }}&mode=asc&status={{ $status }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Asc</a></li>
                <li><a href="{{ route('donation.index') }}?sort={{ $sort }}&mode=desc&status={{ $status }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Desc</a></li>
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
                <li><a href="{{ route('donation.index') }}?sort={{ $sort }}&mode=asc&status=&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">All</a></li>
                <li><a href="{{ route('donation.index') }}?sort={{ $sort }}&mode=desc&status=Belum&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Belum</a></li>
                <li><a href="{{ route('donation.index') }}?sort={{ $sort }}&mode=desc&status=Sudah&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Sudah</a></li>
                <li><a href="{{ route('donation.index') }}?sort={{ $sort }}&mode=desc&status=Tunda&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Tunda</a></li>
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
        <form class="form-inline pull-right" action="{{ route('donation.index') }}" method="get">
            <div class="form-group">
                <input type="text" class="form-control input-sm" id="search" name="cari" placeholder="Pencarian..." value="{{ $cari }}">
                <input type="text" class="form-control input-sm datepicker-month" id="cari_bulan" name="cari_bulan" placeholder="Bulan" value="{{ $cari_bulan }}">
                <input type="hidden" name="sort" value="{{ $sort }}">
                <input type="hidden" name="mode" value="{{ $mode }}">
                <input type="hidden" name="status" value="{{ $status }}">
            </div>
            <button type="submit" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-search"></span>
                Cari
            </button>
        </form>
    </div>
</div><br>

<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="10%">Tanggal</th>
                <th width="10%">Ponsel</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Dikirim</th>
                <th width="10%">Pengirim</th>
                <th width="10%">Keperluan</th>
                <th width="10%">Keterangan</th>
                <th width="10%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $donation_all->firstItem() ?>
            @forelse($donation_all as $donation)
            <tr>
                <td>{{ $nomor++ }}.</td>
                <td>{{ $donation->tanggal }}</td>
                <td>{{ $donation->ponsel }}</td>
                <td>{{ $donation->jumlah }}</td>
                <td>{{ $donation->tanggal_kirim }}</td>
                <td>{{ $donation->pengirim }}</td>
                <td>{{ $donation->keperluan }}</td>
                <td>{{ $donation->Keterangan }}</td>
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
                            <li><a href="">Verifikasi</a></li>
                            <li><a href="">Tunda</a></li>
                            <li><a href="">Belum</a></li>
                            <li class="divider"></li>
                            <li><a href=""><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
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
    {!! $donation_all->appends(compact('sort', 'mode', 'status', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $donation_all->count() }} dari total {{ $donation_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}' dengan status '{{ $status }}'</small>
    </p>
</div>


@stop