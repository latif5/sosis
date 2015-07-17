@extends ('_layouts.dashboard')

@section ('content')
<h1 class="page-header">Tulis Pesan <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Tulis Pesan</h3>
            </div>
            {!! Form::open(['route' => 'send.store']) !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>No. Tujuan</label>
                            <?php // $contact_options[''] = '- pilih -'; ?>
                            {!! Form::select('DestinationNumber[]', $contact_options, null, $attributes = ['class' => 'form-control selectpicker show-tick', 'data-live-search' => 'true', 'multiple', 'data-selected-text-format' => 'count']) !!}
                            {!! $errors->first('DestinationNumber', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                        <div class="form-group">
                            <label>Grup</label>
                            <?php $group_options[''] = '- pilih -'; ?>
                            {!! Form::select('group', $group_options, null, $attributes = ['class' => 'form-control selectpicker show-tick', 'data-live-search' => 'true']) !!}
                            {!! $errors->first('group', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Pesan</label>
                            {!! Form::textarea('TextDecoded', null, $attributes = ['class' => 'form-control', 'id' => 'pesan', 'rows' => '6']) !!}
                            <small id="count_message"></small>
                            {!! $errors->first('TextDecoded', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Penjadwalan</label>
                            {!! Form::text('SendingDateTime', null/*date('Y-m-d H:i:s')*/, array('class' => 'form-control datetimepicker')) !!}
                            {!! $errors->first('SendingDateTime', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            {!! Form::select('Class', array(
                                '-1'    => '-pilih-',
                                '-1'    => 'Normal',
                                '0'     => 'Flash'
                            ), null, $attributes = ['class' => 'form-control selectpicker']) !!}
                            {!! $errors->first('Class', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                    </div>
                </div> <!-- ./row -->
            </div> {{-- panel-body --}}
                
            <div class="panel-footer">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Kirim</button>

                    <button class="btn btn-success pull-right"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
                </div> {{-- .btn-group --}}
            </div> {{-- .panel-footer --}}
            {!! Form::close() !!}
        </div> {{-- .panel --}}
    </div>
</div>
@stop