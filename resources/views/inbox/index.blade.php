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
                <li><a href="{{ route('inbox.index') }}?sort=ReceivingDateTime&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Tanggal</a></li>
                <li><a href="{{ route('inbox.index') }}?sort=Processed&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Status</a></li>
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
                <li><a href="{{ route('inbox.index') }}?sort={{ $sort }}&mode=asc&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Asc</a></li>
                <li><a href="{{ route('inbox.index') }}?sort={{ $sort }}&mode=desc&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Desc</a></li>
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
                            <li><a href="#" data-toggle="modal" data-target="#modalBalas{{ $inbox->ID }}"><span class="glyphicon glyphicon-comment"></span> Balas</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-share-alt"></span> Teruskan</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('inbox.delete', [$inbox->ID]) }}"><span class="glyphicon glyphicon-trash"></span> Hapus</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
<!-- Awal Modal Balas -->
<div class="modal fade" id="modalBalas{{ $inbox->ID }}" tabindex="-1" role="dialog" aria-labelledby="myModalBalasLabel{{ $inbox->ID }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalBalasLabel{{ $inbox->ID }}">Balas</h4>
            </div>
            <div class="modal-body">
                <blockquote>
                  <p>{{ $inbox->TextDecoded }}</p>
                  <footer>{{ $inbox->SenderNumber }} <cite>Contact Name</cite></footer>
                </blockquote>
                {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::hidden('DestinationNumber', $inbox->SenderNumber, $attributes = ['class' => 'form-control']) !!}
                        {!! $errors->first('DestinationNumber', '<p class="text-danger"><small>:message</small></p>') !!}
                    </div>

                    <div class="form-group">
                        {!! Form::textarea('TextDecoded', null, $attributes = ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Ketik balasan di sini...']) !!}
                        {!! $errors->first('TextDecoded', '<p class="text-danger"><small>:message</small></p>') !!}
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Kirim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Balas -->
            @empty
            <tr>
                <td colspan="6">
                    <p>Tidak ada pesan yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $inbox_all->appends(compact('sort', 'mode', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $inbox_all->count() }} dari total {{ $inbox_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
    </p>
</div>


@stop