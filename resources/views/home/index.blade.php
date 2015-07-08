@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">SOSIS <small>Software SMS Otomatis</small></h1>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h3>Kotak Masuk</h3>
                <p>Total ada 2.000 pesan di kotak masuk, dan 3 di antaranya belum diproses</p>
            </div>
            <div class="panel-footer">
                <a href="{{ route('inbox.index') }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-envelope"></span> Detil &raquo;</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h3>Kotak Keluar</h3>
                <p>Masih ada 9 pesan dalam antrian di kotak keluar</p>
            </div>
            <div class="panel-footer">
                <a href="{{ route('outbox.index') }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-inbox"></span> Detil &raquo;</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h3>Pesan Terkirim</h3>
                <p>Ada 3.000 yang telah dikirim, dengan status 2.000 terkirim dan 1.000 gagal dikirim</p>
            </div>
            <div class="panel-footer">
                <a href="{{ route('sentitem.index') }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-saved"></span> Detil &raquo;</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h3>Kontak</h3>
                <p>Terdapat 1.000 kontak yang terbagi menjadi 12 grup</p>
            </div>
            <div class="panel-footer">
                <a href="{{ route('contact.index') }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-book"></span> Detil &raquo;</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h3>Data Pembayaran</h3>
                <p>Terdapat 23 konfirmasi yang belum diverifikasi, dari total 50 data konfirmasi pembayaran</p>
            </div>
            <div class="panel-footer">
                <a href="{{ route('confirmation.index') }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-transfer"></span> Detil &raquo;</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h3>Data Donasi</h3>
                <p>Terdapat 3 konfirmasi yang belum diverifikasi, dari total 20 data konfirmasi donasi</p>
            </div>
            <div class="panel-footer">
                <a href="{{ route('donation.index') }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-thumbs-up"></span> Detil &raquo;</a>
            </div>
        </div>
    </div>
</div>
@stop