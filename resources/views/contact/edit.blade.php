@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kontak <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Ubah Kontak</h3>
            </div>
            {!! Form::model($contact, ['route' => ['contact.update', $contact->id], 'method' => 'put']) !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama</label>
                            {!! Form::text('nama', null, $attributes = ['class' => 'form-control']) !!}
                            {!! $errors->first('nama', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                        <div class="form-group">
                            <label>Nomor Ponsel</label>
                            {!! Form::text('ponsel', null, $attributes = ['class' => 'form-control', 'placeholder' => '62...']) !!}
                            {!! $errors->first('ponsel', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                        <div class="form-group">
                            <label>Grup</label>
                            {!! Form::select('group[]', $group_options, $group_selected, $attributes = ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'multiple']) !!}
                            {!! $errors->first('group', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Keterangan</label>
                            {!! Form::textarea('keterangan', null, $attributes = ['class' => 'form-control', 'rows' => '6']) !!}
                            {!! $errors->first('keterangan', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                    </div>
                </div> <!-- ./row -->
            </div> {{-- panel-body --}}
                
            <div class="panel-footer">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>

                    <button class="btn btn-success pull-right"><span class="glyphicon glyphicon-remove-sign"></span> Batal</button>
                </div> {{-- .btn-group --}}
            </div> {{-- .panel-footer --}}
            {!! Form::close() !!}
        </div> {{-- .panel --}}
    </div>
</div>
@stop