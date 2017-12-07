@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Equipo
			<small>Todos</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Todos</li>
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
				<h3 class="box-title">Mis Equipos</h3>
			</div>
			<div class="box-body">
				<table id="table" class="table table-striped">
					<thead>
						<tr>
							<th>Tipo De Juego</th>
							<th>Ciudad</th>
							<th>Estado</th>
							<th>Fecha de partido</th>
							<th class="no-sort">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($teams as $team)
						<tr>
							<td>{{ $team->game_type->name() }}</td>
							<td>{{ $team->city->name() }}</td>

							@if($team->complete == 0)
								<td> incompleto </td>
							@else
								<td> completo </td>
							@endif

							<td>{{ ucfirst($team->init_hour)}}</td>
							<td>
								<a href="/team/{{ $team->id }}/edit" class="btn btn-warning btn-xs">Editar</a>
								<button onclick="delete_team('{{ $team->id }}')" class="btn btn-danger btn-xs">Eliminar</button>

								@if($team->complete == 1)
									<a id="search_opponent" team="{{ $team->id }}" href="#" class="btn btn-success btn-xs">Buscar equipo oponente</a>
									<a id="cancel_search_opp" href="#" class="btn btn-danger btn-xs hidden">Cancelar búsqueda</a>
								@else
									<a href="/team/{{ $team->id}}/players" class="btn btn-primary btn-xs">Agregar Jugadores</a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="box-footer">
				<a href="/" class="btn btn-default btn-flat">Volver</a>
			</div>
		</div>
	</section>
</div>

@section('modals')
<!-- Modal -->
<div class="modal fade" id="DeleteModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Eliminar Equipo</h4>
			</div>
			<form id="form-delete" method="POST" role="form">
			{{ csrf_field() }}
			<div class="modal-body">
				<p> Desea eliminar el equipo?</p>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger pull-left" >Si, eliminar</button>
				<button type="button" class="btn btn-default pull-rigth" data-dismiss="modal">No, Cancelar</button>
			</div>
			</form>
		</div>

	</div>
</div>
@endsection
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}"/>
@endsection('style')

@section('script')
<script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>	

<script>
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})
</script>

<script>
	function delete_team(id){
		$('#form-delete').attr('action', '/team/delete/'+id);
		$('#DeleteModal').modal('toggle');
	};
</script>

<script>
	var interval = null;
	var ajaxSearch = function(){
		$.ajax({
            type: 'POST',
            url: "/team/search_opponent",
            data: {
                '_token': "{{ csrf_token() }}",
                'team_id': $('#search_opponent').attr('team'),
            },
            success: function(data) 
            {
            }
        }).done(function(data){
        	console.log(data);
        });
	};

	$('#search_opponent').click(function(){
		$(this).text('Buscando oponente...');
		$(this).append(' <i class="fa fa-spin fa-refresh"></i>');
		$(this).addClass('disabled');
		$('#cancel_search_opp').removeClass('hidden');

		interval = setInterval(ajaxSearch, 5000);
	});

	$('#cancel_search_opp').click(function(){
		$('#search_opponent').text('Buscar oponente');
		$('#search_opponent').removeClass('disabled');
		$(this).addClass('hidden');

		$.ajax({
            type: 'POST',
            url: "/team/cancel_search_opponent",
            data: {
                '_token': "{{ csrf_token() }}",
                'team_id': $('#search_opponent').attr('team'),
            },
            success: function(data) 
            {
            }
        }).done(function(data){
        	console.log(data);
        });

		clearInterval(interval);
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