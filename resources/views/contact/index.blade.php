@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kontak <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <a href="{{ route('contact.create') }}" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-plus"></span> 
                Tambahkan
            </a>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('contact.create') }}">Satuan</a></li>
                <li><a href="#">Import</a></li>
            </ul>
        </div>
    </div>

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
                <li><a href="#">Nama</a></li>
                <li><a href="#">Tanggal</a></li>
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
                <li><a href="#">Asc</a></li>
                <li><a href="#">Desc</a></li>
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
        <form class="form-inline pull-right">
            <div class="form-group">
                <input type="text" class="form-control input-sm" id="search" name="cari" placeholder="Pencarian..." value="">
                <input type="hidden" name="sort" value="">
                <input type="hidden" name="arrange" value="">
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
                <th width="15%">Nama</th>
                <th width="15%">Nomor</th>
                <th width="35%">Keterangan</th>
                <th width="25%">Group</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td>Miftah Afina</td>
                <td>0857 4230 2328</td>
                <td>Staf Dokumentasi dan Publikasi</td>
                <td>
                    <span class="label label-default">Pegawai</span>
                    <span class="label label-default">Tarbiyah</span>
                    <span class="label label-default">Dakwah dan Humas</span>
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
                            <li><a href=""><span class="glyphicon glyphicon-edit"></span> Ubah</a></li>
                            <li class="divider"></li>
                            <li><a href=""><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        Menampilkan 5 dari total 10 pesan <br>
        <small class="text-muted">dengan urutan berdasarkan tanggal (desc) untuk kata kunci 'ada'</small>
    </p>
</div>


@stop