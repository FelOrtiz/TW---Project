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
				<h3 class="box-title">Jugadores </h3>
				<div class="pull-right box-tools ">

					<button id="search" type="button" class="btn btn-primary btn-xs">
					Buscar </button>

					<button id="stop" type="button" class="btn btn-danger btn-xs" disabled>Parar Busqueda </button>

					<a id="save" href="/team/index" class="btn btn-success btn-xs">Guardar Equipo</a>

					
				</div>	
			</div>
			<div class="box-body">
			<div class="row">
				<div id="playersfree2" class="col-sm-6">
				<div class="panel panel-body">
					<h5><b>Jugadores Disponibles</b></h5>
					<table id="playersfree" class="table table-striped">
						<thead>
							<tr>
								<th>Nombre Jugador</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="show_players">
                    	<!--Cargar con jquery-->
                		</tbody>
						<!-- add partial view tableplayers-->	
					</table>
				</div>
				</div>
				<div id="myteamplayers" class="col-sm-6">
				<div class="panel panel-body">
					<!-- add table my players-->
					<h5><b>Tus jugadores</b></h5>
					<table class="table" id="tableplayersteam">
                	<thead>
                    	<tr>
	                        <th>Nombre Jugador</th>
                    	</tr>
                	</thead>
                	<tbody>
                    	<!--Cargar con jquery-->
                	</tbody>
            		</table>
				</div>
				</div>
			</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('modals')
<!-- Modal -->
<div class="modal fade" id="modalinfo" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Información</b></h4>
			</div>
			<div class="modal-body">
				<p id="parrafo"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>

	</div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}"/>
@endsection('style')

@section('script')
<script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>	

<script>
	var interval = null; 
	$('#search').click(function(){
		$('#search').text("Buscando...");
		$('#search').attr("disabled","disabled");
		$('#search').append(" <i class='fa fa-refresh fa-spin'></i>");
		$('#stop').removeAttr("disabled");
		var ajaxCall=function(){
			$.ajax({
	            type: 'POST',
	            url: "/searchplayers",
	            data: {
	                '_token':"{{ csrf_token() }}",
	                'init_hour':"{{ $team->init_hour}}",
	                'city_id': "{{ $team->city_id}}",
	                'gametype_id': "{{ $team->gametype_id}}",
	                'team':"{{$team->id}}"
	            },
	            success: function(data) {
	                $('#show_players').html(data.html);
	            },
			    error: function (result) {
			        $('#modalinfo .modal-body #parrafo').text("Existieron algunos errores.");
        			$('#modalinfo').modal('show');
			    }
	        });
	     }
	    interval = setInterval(ajaxCall,1000);
	});

	$('#stop').click(function(){
		$('#stop').attr("disabled", "disabled");
		$('#search').text("Buscar");
		$('#search').removeAttr("disabled", "disabled");
		clearInterval(interval);
	});

	$('#save').click(function(){

	});


</script>

<script>
	function addplayer(id){
		console.log(id);
		$.ajax({
            type: 'POST',
            url: "/addplayer",
            data: {
                '_token':"{{ csrf_token() }}",
                'player_id':id,
                'team_responsible':"{{$team->responsible_id}}",
                'team_id':"{{$team->id}}",
                'gametype_id':"{{ $team->gametype_id}}"
            },
            success: function(data) {
            	console.log(data.person);
            	if(data.players.length < data.capacity){
            		$('#tr-'+id).remove();
            		$('#tableplayersteam tbody').append("<tr><td>" +data.person.firstname+" "+ data.person.lastname+"</td></tr>")
            	}
        		else{
        			$('#modalinfo .modal-body #parrafo').text("El equipo ya está completo puede guardar su equipo para el partido, posteriormente se le será notificado a los jugadores que han sido elegidos.");
        			$('#modalinfo').modal('show');
        		}
        		
            },
		    error: function (result) {
		        $('#modalinfo .modal-body #parrafo').text("Existieron algunos errores.");
        		$('#modalinfo').modal('show');
		    }
        });
	};
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