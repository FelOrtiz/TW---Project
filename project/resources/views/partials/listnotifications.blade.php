@foreach($Notifications as $notification)
<li>
	<a href="#">Seleccionado para jugar el : {{ $notification->init_hour }}</a>
</li>
@endforeach