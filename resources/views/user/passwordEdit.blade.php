@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Pengguna <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Ubah Pengguna</h3>
            </div>
            {!! Form::open(['route' => ['user.password.update'], 'method' => 'PUT']) !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Kata sandi lama</label>
                            {!! Form::input('password', 'passwordLama', null, $attributes = ['class' => 'form-control']) !!}
                            {!! $errors->first('passwordLama', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                        <div class="form-group">
                            <label>Kata sandi baru</label>
                            {!! Form::input('password', 'password', null, $attributes = ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi kata sandi baru</label>
                            {!! Form::input('password', 'password_confirmation', null, $attributes = ['class' => 'form-control']) !!}
                            {!! $errors->first('password', '<p class="text-danger"><small>:message</small></p>') !!}
                        </div>
                    </div>
                </div> <!-- ./row -->
            </div> {{-- panel-body --}}
                
            <div class="panel-footer">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>

                    <a href="{{ route('user.index') }}" class="btn btn-success pull-right"><span class="glyphicon glyphicon-remove-sign"></span> Batal</a>
                </div> {{-- .btn-group --}}
            </div> {{-- .panel-footer --}}
            {!! Form::close() !!}
        </div> {{-- .panel --}}
    </div>
</div>
@stop