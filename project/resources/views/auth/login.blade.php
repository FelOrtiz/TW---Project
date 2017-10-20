<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Log in</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/Ionicons/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="../../index2.html"><b>Admin</b>LTE</a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>

			<form role="form" method="POST" action="{{ route('login') }}">
				{{ csrf_field() }}
				<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
					<input id="password" type="password" class="form-control" name="password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }} "></script>
	<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
</body>
</html>


