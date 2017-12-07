<!DOCTYPE html>
<html>
@include('partials.styles')
@yield('style')
<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">
		@include('partials.header')
		<div class="content-wrapper">
			@yield('content')
		</div>
		@include('partials.footer')
	</div>

	@yield('modals')
	@include('partials.scripts')
	@yield('script')

	<script type="text/javascript">
		var ajaxCall=function(){
			$.ajax({
	            type: 'POST',
	            url:'/isacepted',
	            data: {
                '_token':"{{ csrf_token() }}",
            	},
	            success: function(data) {
	                if(data.isAcepted == "Acepted"){
	                	$('#modalinfo .modal-body #parrafo').text("Haz sido seleccionado por "+ data.Team +", fecha: "+ data.Hour);
        				$('#modalinfo').modal('show');
	                }

	            },
			    error: function (result) {
			        
			    }
	        });
	     }
	    interval = setInterval(ajaxCall,10000);

		function stopfunction(){
			clearInterval(interval);
		};

	</script>

	<!-- Modal -->
	<div class="modal fade" id="modalinfo" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="stopfunction()" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><span class="glyphicon glyphicon-info-sign"></span><b>Información</b></h4>
				</div>
				<div class="modal-body">
					<p id="parrafo"></p>
				</div>
				<div class="modal-footer">
					<button  onclick="stopfunction()" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>

		</div>
	</div>

</body>
</html>
