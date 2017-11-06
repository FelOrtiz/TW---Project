@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Recinto
			<small>Editar</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Editar</li>
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

		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Editar Recinto</h3>
			</div>
			<form method="POST" role="form" action="/enclosure/update/{{ $enclosure->id }}">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error': '' }}">
								<label>Nombre</label>
								<input type="text" class="form-control" placeholder="EJ: futbol 7" name="name" value="{{ $enclosure->name }}">
								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('institution_id') ? 'has-error': '' }}">
								<label>Institución</label>
								<select class="form-control" name="institution_id">
									@foreach($institutions as $institution)
										@if($institution->id == $enclosure->institution_id)
											<option value="{{ $institution->id }}" selected="">{{ $institution->name }}</option>
										@else
											<option value="{{ $institution->id }}">{{ $institution->name }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('institution_id'))
								<span class="help-block">
									<strong>{{ $errors->first('institution_id') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('city_id') ? 'has-error': '' }}">
								<label>Ciudad</label>
								<select class="form-control" name="city_id">
									@foreach($cities as $city)
										@if($city->id == $enclosure->city_id)
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
							<div class="form-group has-feedback {{ $errors->has('address') ? 'has-error': '' }}">
								<label>Dirección</label>
								<input type="text" class="form-control" placeholder="EJ:  Camilo Henriquez S/N" name="address" value="{{ $enclosure->address }}">
								@if ($errors->has('address'))
								<span class="help-block">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('responsible_id') ? 'has-error': '' }}">
								<label>Responsable</label>
								<select class="form-control" name="responsible_id">
									@foreach($people as $person)
										@if($person->id == $enclosure->responsible_id)
											<option value="{{ $person->id }}" selected="">{{ $person->name() }}</option>
										@else
											<option value="{{ $person->id }}">{{ $person->name() }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('responsible_id'))
								<span class="help-block">
									<strong>{{ $errors->first('responsible_id') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a href="/" class="btn btn-default btn-flat">Volver</a>
					<button type="submit" class="btn btn-warning btn-flat pull-right">Editar Recinto </button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection