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
        {!! Form::open(['method' => 'get', 'class' => 'form-inline pull-right']) !!}
                {!! Form::hidden('sort', $sort) !!}
                {!! Form::hidden('mode', $mode) !!}
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

{{-- Awal form multiple delete --}}
{!! Form::open(['route' => 'sentitem.delete.multiple']) !!}
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
                <td>
                    {{-- Tombol checkbox multiple delete --}}
                    <div class="checkbox checkbox-circle checkbox-danger">
                        {!! Form::checkbox('check[]', $sentitem->ID, false, ['id' => 'check-'.$sentitem->ID, 'class' => 'styled']) !!}
                        {!! Form::label('check-'.$sentitem->ID, $nomor++) !!}
                    </div>
                </td>
                <td>
                    <small>{{ date('d M Y H:i:s', strtotime($sentitem->SendingDateTime)) }}</small>
                    <br>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($sentitem->SendingDateTime)->diffForHumans() }}</small>
                </td>
                <td>
                    <small>{{ $sentitem->DestinationNumber }}</small>
                    <br>
                    <small>{{ $sentitem->nama }}</small>
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
                            <li><a href="#" data-toggle="modal" data-target="#modalDetil{{ $sentitem->ID }}"><span class="glyphicon glyphicon-eye-open"></span> Detail</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('sentitem.delete', [$sentitem->ID]) }}" data-toggle="confirmation"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>

                        </ul>
                    </div>
                </td>
            </tr>
            @include('sentitem._partials.modal_detil')
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
{{-- Tombol multiple delete --}}
<button type="submit" class="btn btn-danger">
    <span class="glyphicon glyphicon-trash"></span> 
    Hapus item terpilih
</button>
{!! Form::close() !!}
{{-- Akhir form multiple delete --}}

@stop