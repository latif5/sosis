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
                <li><a href="#">Tanggal</a></li>
                <li><a href="#">Status</a></li>
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

    <div class="col-md-6">
        <form class="form-inline pull-right">
            <div class="form-group">
                <input type="text" class="form-control input-sm" id="search" name="cari" placeholder="Pencarian..." value="">
                <input type="text" class="form-control input-sm datepicker-month" id="cari_bulan" name="cari_bulan" placeholder="Bulan" value="">
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
                <th width="10%">Tanggal</th>
                <th width="10%">Ponsel</th>
                <th width="10%">Santri</th>
                <th width="10%">Kelas</th>
                <th width="10%">Jumlah</th>
                <th width="10%">Dikirim</th>
                <th width="10%">Pengirim</th>
                <th width="10%">Keperluan</th>
                <th width="10%">Status</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td>4 Mei 2015</td>
                <td>085742302328</td>
                <td>Steven</td>
                <td>7A</td>
                <td>1.000.000</td>
                <td>3 Mei 2015</td>
                <td>Agus S.</td>
                <td>SPP bulan Juli</td>
                <td>
                    <span class="label label-success">Sudah</span>
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
        </tbody>
    </table>
    <p>
        Menampilkan 5 dari total 10 pesan <br>
        <small class="text-muted">dengan urutan berdasarkan tanggal (desc) untuk kata kunci 'ada'</small>
    </p>
</div>


@stop