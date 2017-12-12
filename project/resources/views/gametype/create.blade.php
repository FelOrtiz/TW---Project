@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Tipo de Juego
			<small>Registrar</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="/gametype/index"><i class="fa fa-home"></i> Tipos de Juego</a></li>
			<li class="active">Registrar</li>
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
				<h3 class="box-title">Registrar Tipo de Juego</h3>
			</div>
			<form method="POST" role="form" action="/gametype">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error': '' }}">
								<label>Nombre</label>
								<input type="text" class="form-control" placeholder="Ej: futbol 7" name="name">
								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-feedback {{ $errors->has('capacity') ? 'has-error': '' }}">
								<label>Capacidad</label>
								<input type="number" class="form-control" name="capacity" min="1" max="30">
								@if ($errors->has('capacity'))
								<span class="help-block">
									<strong>{{ $errors->first('capacity') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-feedback {{ $errors->has('duration') ? 'has-error': '' }}">
								<label>Duración <small>(En horas)</small></label>
								<input type="number" class="form-control" name="duration" min="1" max="12">
								@if ($errors->has('duration'))
								<span class="help-block">
									<strong>{{ $errors->first('duration') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a href="/" class="btn btn-default btn-flat">Volver</a>
					<button type="submit" class="btn btn-success btn-flat pull-right">Registrar Tipo Juego</button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection