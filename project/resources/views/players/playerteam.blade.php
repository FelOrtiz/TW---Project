@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Equipo
			<small>Completar</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Completar</li>
		</ol>
	</section>

	<section class="content">
		@if(session('message'))
		<div class="alert alert-{{ session('type') }} alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa {{ session('icon') }}"></i> {{ session('title') }}</h4>
			{{ session('message') }}
		</div>
		@endif
		
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Completar Equipo</h3>
			</div>
			<form method="POST" role="form" action="/team">
				{{ csrf_field() }}
				
				<div class="box-footer">
					<a href="/" class="btn btn-default btn-flat">Volver</a>
					<button type="submit" class="btn btn-success btn-flat pull-right">Terminar </button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection