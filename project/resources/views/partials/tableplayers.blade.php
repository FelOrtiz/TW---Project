@foreach($players as $player)
<tr id="tr-{{$player->id}}">
	<td id="nameplayer-{{$player->id}}">{{ $player->name() }}</td>
	<td>
		<button id="player-{{$player->id}}"  onclick="addplayer('{{ $player->id }}')" class="btn btn-success btn-xs">Agregar al equipo</button>
	</td>
</tr>
@endforeach




