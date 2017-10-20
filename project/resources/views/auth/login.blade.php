@extends('layouts.auth')

@section('title')
<title>Gestión Canchas | Iniciar sesión</title>
@endsection

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="/"><b>Gestión</b> Canchas</a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>

		<form role="form" method="POST" action="{{ route('login') }}">
			{{ csrf_field() }}
			<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
				<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
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
			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar sesión</button>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-6">
					<a href="/register">Registrarme</a>
				</div>
				<div class="col-md-6">
					<a href="/password/reset" class="pull-right">Olvidé mi password</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection