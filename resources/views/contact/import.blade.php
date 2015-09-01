@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kontak <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Import Kontak</h3>
            </div>
            {!! Form::open(['route' => 'contact.import.put', 'files' => true, 'method' => 'put']) !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Data</label>
                            <div class="well well-sm">
                                {!! Form::file('data') !!}
                            </div>
                            {!! $errors->first('data', '<p class="text-danger"><small>:message</small></p>') !!}
                            <small class="text-muted">Format file harus berupa <strong>nama - keterangan - no.  ponsel</strong> tanpa tabel heading, dengan ekstensi xls atau xlsx</small>
                        </div>
                        <div class="form-group">
                            <label>Grup</label>
                            {!! Form::select('group[]', $group_options, null, $attributes = ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'multiple', 'data-selected-text-format' => 'count']) !!}
                            {!! $errors->first('group', '<p class="text-danger"><small>:message</small></p>') !!}
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