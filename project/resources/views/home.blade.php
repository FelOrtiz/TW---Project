@extends('layouts.app')

@section('content')

<div class="row">
	<div class="wrap">
		<ul id="pictures">
			<li title="Fútbol">
				<img src="{{ asset('img/football.jpg') }}" alt="Fútbol">
			</li>
			<li title="Básquetbol">
				<img src="{{ asset('img/basket.jpg') }}"  alt="Básquetbol">
			</li>
			<li title="Tenis">
				<img src="{{ asset('img/tennis.jpg') }}" alt="Tenis">
			</li>
			<li title="Rugby">
				<img src="{{ asset('img/rugby.jpg') }}" alt="Rugby">
			</li>
			<li title="Vóleibol">
				<img src="{{ asset('img/voley.jpg') }}" alt="Vóleibol">
			</li>
		</ul>
		<h1 class="wrap-title text-center hidden-sm hidden-xs">Gestión Canchas</h1>
	</div>
</div>
<br/>
<div class="container">
	<section class="content">
		<div class="row">
			<div class="col-md-3 text-center">
				<i class="fa fa-calendar fa-4x"></i>
				<h2>Reservas</h2>
				<p>Gestiona la reserva para una cancha en un recinto de tu ciudad según la hora de tu preferencia.</p>
				<br/>
			</div>
			<div class="col-md-3 text-center">
				<i class="fa fa-users fa-4x"></i>
				<h2>Equipos</h2>
				<p>Crea un equipo para jugar tu deporte favorito, luego busca jugadores con el mismo criterio y empieza a jugar!</p>
				<br/>
			</div>
			<div class="col-md-3 text-center">
				<i class="fa fa-soccer-ball-o fa-4x"></i>
				<h2>A Jugar!</h2>
				<p>Si deseas jugar tu deporte favorito, pero no tienes equipo. No te preocupes, con esta función podrás buscar equipos incompletos y podrás unirte a ellos.</p>
				<br/>
			</div>
			<div class="col-md-3 text-center">
				<i class="fa fa-suitcase fa-4x"></i>
				<h2>Administración</h2>
				<p>Si eres dueño de una institución, puedes mantener las gestión de sus canchas a través de esta plataforma. Regístrate y compienza!</p>
				<br/>
			</div>
		</div>
	</section>
</div>
@endsection



@section('script')

<script>
$('#pictures').slippry({
  slippryWrapper: '<div class="sy-box pictures-slider" />', // wrapper to wrap everything, including pager

  adaptiveHeight: true, // height of the sliders adapts to current slide
  captions: true, // Position: overlay, below, custom, false

  pager: false,

  controls: false,
  autoHover: false,

  transition: 'kenburns', // fade, horizontal, kenburns, false
  kenZoom: 140,
  speed: 2000 // time the transition takes (ms)
});
</script>

<script>
	var ajaxCall=function(){
		console.log("entro");
		$.ajax({
            type: 'POST',
            url:'/isacepted',
            data: {
            '_token':"{{ csrf_token() }}",
        	},
            success: function(data) {
            	$('#Menu_Noti').html(data.html);
            	if(data.size > 0){
            		$('#count_Notificaction').text(data.size.toString());
            	}
            	else
            	{
            		$('#count_Notificaction').text("");
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

<script>
	function viewNotification(id){
		console.log(id);
		$.ajax({
            type: 'POST',
            url: "/updateNotificaction",
            data: {
                '_token':"{{ csrf_token() }}",
                'notification_id':id
            },
            success: function(data) {
            	console.log(data);

        		    $('#modalinfo .modal-body #parrafo').text(data.info);
        			$('#modalinfo').modal('show');
            },
		    error: function (result) {
		        $('#modalinfo .modal-body #parrafo').text("Existieron algunos errores.");
        		$('#modalinfo').modal('show');
		    }
        });
	};
</script>
@endsection
