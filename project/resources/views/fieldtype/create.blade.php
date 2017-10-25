@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Tipo de Cancha
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
				<h3 class="box-title">Registrar Tipo de Cancha</h3>
			</div>
			<form method="POST" role="form" action="/fieldtype">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error': '' }}">
								<label>Nombre</label>
								<input type="text" class="form-control" placeholder="EJ: Sintetica" name="name">
								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a href="/" class="btn btn-default btn-flat">Volver</a>
					<button type="submit" class="btn btn-success btn-flat pull-right">Registrar Tipo Cancha </button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection