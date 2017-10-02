<!DOCTYPE html>
<html>
@include('partials.styles')
<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">
		@include('partials.header')
		<div class="content-wrapper">
			@yield('content')
		</div>
		@include('partials.footer')
	</div>

	@yield('modals')
	@include('partials.scripts')
	@yield('script')
</body>
</html>
