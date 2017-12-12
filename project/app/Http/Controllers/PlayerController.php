<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Player;
use Carbon\Carbon;
use App\Team;
use App\Person;
use App\City;
use App\GameType;
use App\PlayerWT;
use App\User;


class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchTeam()
    {
    	$people = Person::all(); //para el select
        $cities = City::all();
        $gametypes = GameType::all();

        return view('player.searchteam', compact('people','cities','gametypes'));
    }

    //método que almacena un playerwt en la BD
    public function store(Request $request)
    {
        //validar la petición
        $validator = Validator::make($request->all(), [
            'gametype_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'init_hour' => 'required|date_format:H:i',
        ]);

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('player/searchteam')->withErrors($validator)->withInput();
        }

        //creamos el equipo
        $date = $request['init_date'];
        $hour = $request['init_hour'];
        $finaldate = $date.' '.$hour;
        PlayerWT::create([
            'person_id' => auth()->user()->id,
            'gametype_id' => $request['gametype_id'],
            'hour' => $finaldate
        ]);

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La busqueda se ha registrado exitosamente, recibiras una notificación si haz sido elegido para algun partido!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('player/searchteam');        
    }

    public function isAcepted()
    {
        $session_id =  auth()->user()->id ;
        $players = Player::all();
        $notifications = array();

        foreach ($players as $player) {
            if($player->person_id == $session_id )
            {
                $team = Team::find($player->team_id);
                $person = Person::find($team->responsible_id);
                //enviar lista de aceptacion en equipo :D
                array_push($notifications,$team);   
            }
        }

        $size = sizeof($notifications);
        $returnHTML = view('partials.listnotifications')->with('Notifications',$notifications)->render();
        return response()->json(array('success'=>true, 'html'=>$returnHTML,'size'=>$size));
        //return response()->json(array('Notifications'=>$notifications));
        
    }
}
