@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Tulis Pesan <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Tulis Pesan</h3>
            </div>
            {!! Form::open() !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>No. Tujuan</label>
                            {!! Form::text('DestinationNumber', null, $attributes = ['class' => 'form-control']) !!}
                            {{ $errors->first('DestinationNumber', '<p class="text-danger"><small>:message</small></p>') }}
                        </div>
                        <div class="form-group">
                            <label>Grup</label>
                            {!! Form::select('group', array(
                                ''      => '-pilih-',
                                '1'     => 'Asatidzah',
                                '2'     => 'Staf',
                                '3'     => 'Karyawan'
                            ), null, $attributes = ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) !!}
                            {{ $errors->first('group', '<p class="text-danger"><small>:message</small></p>') }}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Pesan</label>
                            {!! Form::textarea('TextDecoded', null, $attributes = ['class' => 'form-control', 'id' => 'pesan', 'rows' => '6']) !!}
                            <small id="count_message"></small>
                            {{ $errors->first('TextDecoded', '<p class="text-danger"><small>:message</small></p>') }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Penjadwalan</label>
                            {!! Form::text('tanggal', date('Y-m-d'), array('class' => 'form-control datepicker')) !!}
                            {{ $errors->first('tanggal', '<p class="text-danger"><small>:message</small></p>') }}
                            <small>Ket: Pakai date time picker dari mallot.fr (bookmarked)</small>
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            {!! Form::select('status', array(
                                '-1'    => '-pilih-',
                                '-1'    => 'Normal',
                                '0'     => 'Flash'
                            ), null, $attributes = ['class' => 'form-control selectpicker']) !!}
                            {{ $errors->first('status', '<p class="text-danger"><small>:message</small></p>') }}
                        </div>
                    </div>
                </div> <!-- ./row -->
            </div> {{-- panel-body --}}
                
            <div class="panel-footer">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Kirim</button>

                    <button type="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
                </div> {{-- .btn-group --}}
            </div> {{-- .panel-footer --}}
            {!! Form::close() !!}
        </div> {{-- .panel --}}
    </div>
</div>
@stop