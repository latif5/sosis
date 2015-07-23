@extends('_layouts.login')

@section('content')
            <div class="row">
                <div class="col-md-12" align="center">
                    <img src="{{ asset('assets/img/logo-sosis-large3.png') }}" class="img-responsive" width="300">
                </div>
            </div>


            {!! Form::open(array('url' => '/auth/login', 'class' => 'form-signin')) !!}
                @include('_partials.alert')
    
                <label for="email" class="sr-only">Email</label>
                <input name="email" type="text" id="email" class="form-control" placeholder="Nama Pengguna" autofocus>
                {!! $errors->first('email', '<p class="text-danger"><small>:message</small></p>') !!}

                <label for="password" class="sr-only">Kata Sandi</label>
                <input name="password" type="password" id="password" class="form-control" placeholder="Kata Sandi">
                {!! $errors->first('password', '<p class="text-danger"><small>:message</small></p>') !!}
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Ingatkan saya
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Masuk</button>
            {!! Form::close() !!}
@stop