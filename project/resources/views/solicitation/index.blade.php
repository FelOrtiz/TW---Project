@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Solicitudes
			<small>Todas</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Todas</li>
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
				<h3 class="box-title">Todas las solicitudes</h3>
			</div>
			<div class="box-body">
				<table id="table" class="table">
					<thead>
						<tr>
							<th>Solicitante</th>
							<th>Cancha</th>
							<th>Fecha</th>
							<th>Hora de Inicio</th>
							<th>Duración</th>
						</tr>
					</thead>
					<tbody>
						@foreach($response as $solicitation)
						<tr>
							<td>{{ $solicitation['person_name'] }} </td>
							<td> {{ $solicitation['field_name'] }} </td>
							<td> {{ $solicitation['date'] }}</td>
							<td> {{ $solicitation['hour'] }}</td>
							<td> {{ $solicitation['duration'] }}</td>
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
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}"/>
@endsection('style')

@section('script')
<script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>	

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