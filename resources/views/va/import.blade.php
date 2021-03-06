@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Virtual Account <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Import Data Konfirmasi dari VA</h3>
            </div>
            {!! Form::open(['route' => 'va.import.put', 'files' => true, 'method' => 'put']) !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data</label>
                            <div class="well well-sm">
                                {!! Form::file('data') !!}
                            </div>
                            {!! $errors->first('data', '<p class="text-danger"><small>:message</small></p>') !!}
                            <small class="text-muted">Format file harus berupa <strong>nomor va - nomor ponsel - nama santri - kelas - jumlah transfer - tanggal transfer - nama pengirim - keperluan</strong> tanpa tabel heading, dengan ekstensi xls atau xlsx</small>
                        </div>
                    </div>
                </div> <!-- ./row -->
            </div> {{-- panel-body --}}
                
            <div class="panel-footer">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>

                    <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-remove-sign"></span> Batal</button>
                </div> {{-- .btn-group --}}
            </div> {{-- .panel-footer --}}
            {!! Form::close() !!}
        </div> {{-- .panel --}}
    </div>
</div>
@stop