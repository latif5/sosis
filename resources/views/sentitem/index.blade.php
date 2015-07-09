@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Pesan Terkirim <small>SOSIS</small></h1>

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
                <li><a href="{{ route('sentitem.index') }}?sort=SendingDateTime&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Tanggal</a></li>
                <li><a href="{{ route('sentitem.index') }}?sort=Status&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Status</a></li>
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
                <li><a href="{{ route('sentitem.index') }}?sort={{ $sort }}&mode=asc&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Asc</a></li>
                <li><a href="{{ route('sentitem.index') }}?sort={{ $sort }}&mode=desc&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Desc</a></li>
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

    <div class="col-md-6">
        <form class="form-inline pull-right" action="{{ route('sentitem.index') }}" method="get">
            <div class="form-group">
                <input type="text" class="form-control input-sm" id="search" name="cari" placeholder="Pencarian..." value="{{ $cari }}">
                <input type="text" class="form-control input-sm datepicker-month" id="cari_bulan" name="cari_bulan" placeholder="Bulan" value="{{ $cari_bulan }}">
                <input type="hidden" name="sort" value="{{ $sort }}">
                <input type="hidden" name="mode" value="{{ $mode }}">
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
                <th width="10%">Pengirim</th>
                <th width="60%">Isi Pesan</th>
                <th width="10%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $sentitem_all->firstItem() ?>
            @forelse($sentitem_all as $sentitem)
            <tr>
                <td>{{ $nomor++ }}</td>
                <td>
                    {{ $sentitem->SendingDateTime }}
                    <br>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($sentitem->SendingDateTime)->diffForHumans() }}</small>
                </td>
                <td>
                    {{ $sentitem->DestinationNumber }}
                    <br>
                    <small>Contact Name</small>
                </td>
                <td>{{ $sentitem->TextDecoded }}</td>
                <td>
                    @if($sentitem->Status == 'SendingOK')
                    <span class="label label-success">{{ $sentitem->Status }}</span>
                    @else
                    <span class="label label-danger">{{ $sentitem->Status }}</span>
                    @endif  
                </td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href=""><span class="glyphicon glyphicon-eye-open"></span> Lengkap</a></li>
                            <li class="divider"></li>
                            <li><a href=""><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>

                        </ul>
                    </div>
                </td>
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
    {!! $sentitem_all->appends(compact('sort', 'mode', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $sentitem_all->count() }} dari total {{ $sentitem_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
    </p>
</div>


@stop