@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Equipo
			<small>Editar</small>
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
				<h3 class="box-title">Registrar Equipo</h3>
			</div>
			<form method="POST" role="form" action="/team/update/{{ $team->id }}">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback {{ $errors->has('gametypes_id') ? 'has-error': '' }}">
								<label>Tipo Juego</label>
								<select class="form-control" name="gametype_id">
									@foreach($gametypes as $gametype)
										@if($gametype->id == $team->gametype_id)
											<option value="{{ $gametype->id }}" selected="">{{ $gametype->name }}</option>
										@else
											<option value="{{ $gametype->id }}">{{ $gametype->name }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('gametype_id'))
								<span class="help-block">
									<strong>{{ $errors->first('gametype_id') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('city_id') ? 'has-error': '' }}">
								<label>Ciudad</label>
								<select class="form-control" name="city_id">
									@foreach($cities as $city)
										@if($city->id == $team->city_id)
											<option value="{{ $city->id }}" selected="">{{ $city->name }}</option>
										@else
											<option value="{{ $city->id }}">{{ $city->name }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('city_id'))
								<span class="help-block">
									<strong>{{ $errors->first('city_id') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('init_date') ? 'has-error': '' }}">
								<label>Fecha</label>
								<input type="text" class="form-control" name="init_date" id="init_date">
								@if ($errors->has('init_date'))
								<span class="help-block">
									<strong>{{ $errors->first('init_date') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('init_hour') ? 'has-error': '' }}">
								<label>Hora</label>
								<input type="time" class="form-control" name="init_hour" id="init_hour">
								@if ($errors->has('init_hour'))
								<span class="help-block">
									<strong>{{ $errors->first('init_hour') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a href="/" class="btn btn-default btn-flat">Volver</a>
					<button type="submit" class="btn btn-success btn-flat pull-right">Editar Equipo </button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection
@section('script')
<script>
	$('#init_date').datepicker(
	{
		format: 'yyyy-mm-dd'
	});	
</script>
@endsection