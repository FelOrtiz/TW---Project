@foreach($Notifications as $notification)
<li>
	<a onclick="viewNotification('{{ $notification->id }}')">{{ $notification->info }}</a>
</li>
@endforeach