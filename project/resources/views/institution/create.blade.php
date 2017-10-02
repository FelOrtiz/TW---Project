@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Institución
			<small>Registrar</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Registrar</li>
		</ol>
	</section>

	<section class="content">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Registrar institución</h3>
			</div>
			<form method="POST" role="form" action="/institution">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error': '' }}">
								<label>Nombre</label>
								<input type="text" class="form-control" placeholder="EJ: Universidad de Talca" name="name">
								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('id') ? 'has-error': '' }}">
								<label>Responsable</label>
								<select class="form-control" name="id">
									@foreach($people as $person)
									<option value="{{ $person->id }}">{{ $person->name() }}</option>
									@endforeach
								</select>
								@if ($errors->has('id'))
								<span class="help-block">
									<strong>{{ $errors->first('id') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a href="/" class="btn btn-default btn-flat">Volver</a>
					<button type="submit" class="btn btn-success btn-flat pull-right">Registrar institución</button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection