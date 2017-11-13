@extends('layouts.app')

@section('content')

<div class="container">
	<section class="content-header">
		<h1>
			Completar equipo
			<small>Jugadores</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Jugadores</li>
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
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Todos los Jugadores</h3>
				<div class="pull-right box-tools ">

					<button id="search" type="button" class="btn btn-primary btn-md">
					Buscar </button>

					<button id="stop" type="button" class="btn btn-danger btn-md" disabled>Cancelar </button>

					
				</div>	
			</div>
			<div class="box-body">
				<table id="table2" class="table table-striped">
					<thead>
						<tr>
							<th>Nombre Jugador</th>
							<th class="no-sort">Acciones</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@endsection



@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}"/>
@endsection('style')

@section('script')
<script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>	

<script>
	$('#search').click(function(){
		$('#search').text("Buscando...");
		$('#search').append(" <i class='fa fa-refresh fa-spin'></i>");
		$('#stop').removeAttr("disabled");

		$.ajax({
            type: 'POST',
            url: "/searchplayers",
            data: {
                '_token':"{{ csrf_token() }}",
                'init_hour':"{{ $team->init_hour}}",
                'city_id': "{{ $team->city_id}}",
                'gametype_id': "{{ $team->gametype_id}}"
            },
            success: function(data) {
                // empty
            },
        });
	});
</script>

<script>
	$('#stop').click(function(){
		$('#stop').attr("disabled", "disabled");
		$('#search').text("Buscar");
	});
</script>

<script>
	var table;

	$(document).ready(function () {
		table = $("#table").DataTable({
			"responsive": true,
			"order": [0, 'asc'],
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false }
			], 
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
		});
	});
</script>

@endsection