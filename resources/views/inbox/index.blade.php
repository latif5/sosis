@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kotak Masuk <small>SOSIS</small></h1>

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
                <li><a href="{{ route('inbox.index') }}?sort=ReceivingDateTime&mode={{ $mode }}">Tanggal</a></li>
                <li><a href="{{ route('inbox.index') }}?sort=Processed&mode={{ $mode }}">Status</a></li>
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
                <li><a href="{{ route('inbox.index') }}?sort={{ $sort }}&mode=asc">Asc</a></li>
                <li><a href="{{ route('inbox.index') }}?sort={{ $sort }}&mode=desc">Desc</a></li>
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
        <form class="form-inline pull-right" action="{{ route('inbox.index') }}" method="get">
            <div class="form-group">
                <input type="text" class="form-control input-sm" id="search" name="cari" placeholder="Pencarian..." value="{{ $cari }}">
                <input type="text" class="form-control input-sm datepicker-month" id="cari_bulan" name="cari_bulan" placeholder="Bulan" value="">
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
                <th width="15%">Pengirim</th>
                <th width="60%">Isi Pesan</th>
                <th width="5%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $inbox_all->firstItem() ?>
            @forelse($inbox_all as $inbox)
            <tr>
                <td>{{ $nomor++ }}.</td>
                <td>
                   <small>{{ $inbox->ReceivingDateTime }}</small>
                    <br>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($inbox->ReceivingDateTime)->diffForHumans() }}
                    </small>
                </td>
                <td>
                    {{ $inbox->SenderNumber }}
                    <br>
                    <small>Contact Name</small>
                </td>
                <td>{{ $inbox->TextDecoded }}</td>
                <td>
                    @if($inbox->Processed == 'true')
                    <span class="label label-success">{{ $inbox->Processed }}</span>
                    @else
                    <span class="label label-danger">{{ $inbox->Processed }}</span>
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
                            <li><a href=""><span class="glyphicon glyphicon-comment"></span> Balas</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-share-alt"></span> Teruskan</a></li>
                            <li class="divider"></li>
                            <li><a href=""><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <p>Tidak ada pesan yang diterima.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $inbox_all->appends(['sort' => $sort, 'mode' => $mode, 'cari' => $cari])->render() !!}
    <p>
        Menampilkan {{ $inbox_all->count() }} dari total {{ $inbox_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
    </p>
</div>


@stop