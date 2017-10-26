@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Cancha
			<small>Registrar</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
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
				<h3 class="box-title">Registrar cancha</h3>
			</div>
			<form method="POST" role="form" action="/field">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error': '' }}">
								<label>Nombre</label>
								<input type="text" class="form-control" placeholder="EJ: Cancha 1" name="name">
								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('enclosure_id') ? 'has-error': '' }}">
								<label>Recinto</label>
								<select class="form-control" name="enclosure_id">
									@foreach($enclosures as $enclosure)
									<option value="{{ $enclosure->id }}">{{ $enclosure->name }}</option>
									@endforeach
								</select>
								@if ($errors->has('enclosure_id'))
								<span class="help-block">
									<strong>{{ $errors->first('enclosure_id') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('capacity') ? 'has-error': '' }}">
								<label>Capacidad</label>
								<input type="integer" class="form-control" placeholder="EJ: 12" name="capacity">
								@if ($errors->has('capacity'))
								<span class="help-block">
									<strong>{{ $errors->first('capacity') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('type_id') ? 'has-error': '' }}">
								<label>Tipo</label>
								<select class="form-control" name="type_id">
									@foreach($fieldtype as $fieldType)
									<option value="{{ $fieldType->id }}">{{ $fieldType->name }}</option>
									@endforeach
								</select>
								@if ($errors->has('type_id'))
								<span class="help-block">
									<strong>{{ $errors->first('type_id') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('init_hour') ? 'has-error': '' }}">
								<label>Hora inicio</label>
								<input type="time" class="form-control" name="init_hour">
								@if ($errors->has('init_hour'))
								<span class="help-block">
									<strong>{{ $errors->first('init_hour') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('end_hour') ? 'has-error': '' }}">
								<label>Hora termino</label>
								<input type="time" class="form-control" name="end_hour">
								@if ($errors->has('end_hour'))
								<span class="help-block">
									<strong>{{ $errors->first('end_hour') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a href="/" class="btn btn-default btn-flat">Volver</a>
					<button type="submit" class="btn btn-success btn-flat pull-right">Registrar Cancha </button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection