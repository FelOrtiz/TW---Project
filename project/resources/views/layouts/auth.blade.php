<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@yield('title')
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/Ionicons/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	@yield('content')
	<script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }} "></script>
	<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
</body>
</html>