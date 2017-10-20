@extends('layouts.auth')

@section('title')
<title>Gestión Canchas | Registro</title>
@endsection

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Gestión</b> Canchas</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Ingresa tus datos para registrarte</p>
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" required autofocus>
                <span class="fa fa-user form-control-feedback"></span>
                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('lastname') ? ' has-error' : '' }}">
                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Apellido" required autofocus>
                <span class="fa fa-user form-control-feedback"></span>
                @if ($errors->has('lastname'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('mobile') ? ' has-error' : '' }}">
                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="Teléfono" required autofocus>
                <span class="fa fa-mobile form-control-feedback"></span>
                @if ($errors->has('mobile'))
                <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('birthdate') ? ' has-error' : '' }}">
                <input id="birthdate" type="text" class="form-control" name="birthdate" value="{{ old('birthdate') }}" placeholder="Fecha de nacimiento" required autofocus>
                <span class="fa fa-birthday-cake form-control-feedback"></span>
                @if ($errors->has('birthdate'))
                <span class="help-block">
                    <strong>{{ $errors->first('birthdate') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('city') ? ' has-error' : '' }}">
                <select class="form-control" name="city">
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ ucfirst($city->name) }}</option>
                    @endforeach
                </select>
                @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <span class="fa fa-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('role') ? ' has-error' : '' }}">
                <select class="form-control" name="role">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role'))
                <span class="help-block">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarme</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

