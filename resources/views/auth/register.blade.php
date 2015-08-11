@extends('_layouts.login')

@section('content')
            <div class="row">
                <div class="col-md-12" align="center">
                    <img src="{{ asset('assets/img/oph-logo-dark.png') }}" class="img-responsive">
                </div>
            </div>


            {!! Form::open(array('url' => '/authenticate', 'class' => 'form-signin')) !!}
                @include('_partials.alert')
    
                {{-- <h2 class="form-signin-heading">Silakan Masuk</h2> --}}
                <label for="username" class="sr-only">Email</label>
                <input name="username" type="text" id="username" class="form-control" placeholder="Nama Pengguna" autofocus>
                {{ $errors->first('username', '<p class="text-danger"><small>:message</small></p>') }}
                <label for="password" class="sr-only">Kata Sandi</label>
                <input name="password" type="password" id="password" class="form-control" placeholder="Kata Sandi">
                {{ $errors->first('password', '<p class="text-danger"><small>:message</small></p>') }}
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Ingatkan saya
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Masuk</button>
            {!! Form::close() !!}
@stop