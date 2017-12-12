<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Team;
use App\Person;
use App\City;
use App\GameType;
use App\PlayerWT;
use App\Player;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //retorna todos los 
    public function index()
    {
    	//$teams = Team::all();
        $teams = Team::where('responsible_id',"=",auth()->user()->id)->get();

    	return view('team.index', compact('teams'));
    }

    //método que almacena un nuevo Equipo en la BD
    public function create()
    {
        $people = Person::all(); //para el select
        $cities = City::all();
        $gametypes = GameType::all();

        return view('team.create', compact('people','cities','gametypes'));
    }

    //método que almacena un equipo en la BD
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
            return redirect('team/create')->withErrors($validator)->withInput();
        }

        //creamos el equipo
        $date = $request['init_date'];
        $hour = $request['init_hour'];
        $finaldate = $date.' '.$hour;
        Team::create([
            'responsible_id' => auth()->user()->id,
            'gametype_id' => $request['gametype_id'],
            'complete' => 0,
            'city_id' => $request['city_id'],
            'init_hour' => $finaldate
        ]);

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El Equipo se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('team/index');        
    }

    public function edit(Team $team)
    { 
        $cities = City::all();
        $gametypes = GameType::all();

        return view('team.edit', compact('team','cities','gametypes'));
    }

    public function players(Team $team)
    { 
        return view('team.players',compact('team'));
    }


    public function update(Request $request, $id)
    {
        //validar la petición
        $validator = Validator::make($request->all(), [
            'gametype_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'init_hour' => 'required|date_format:Y-m-d H:i:s'
        ]); 

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('team/edit')->withErrors($validator)->withInput();
        }
        
        //Editar la cancha
        $team = Team::find($id);
        $team->update($request->except ('_token'));


        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El Equipo se ha editado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('team/index'); 
    }

    public function delete(Team $team)
    {
        $team->delete();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El Equipo se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('team/index');
    }

    public function search_player(Request $request)
    {

        $playerwts = PlayerWT::all();
        $players = array();
        

        foreach ($playerwts as $player)
        {
            $person = Person::find($player->person_id);

            if($person->city_id == $request->city_id && 
                $player->hour == $request->init_hour &&
                $player->gametype_id == $request->gametype_id &&
                $player->person_id != $request->responsible_id){
                array_push($players,$person);               
            }
        }
        $returnHTML = view('partials.tableplayers')->with('players',$players)->render();
        return response()->json(array('success'=>true, 'html'=>$returnHTML));

    }

    public function add_players(Request $request)
    {
        $gametype = GameType::find($request->gametype_id);
        $players = Player::where('team_id',"=",$request->team_id)->get();
        $capacity = (($gametype->capacity)/2)-1 ;

        if (sizeof($players) < $capacity ){
            
            //agregar a mi equipo
            Player::create([
                'person_id' => $request->player_id,
                'team_id' => $request->team_id,
                'team_responsible' => $request->team_responsible
                
            ]);

            //notificar al jugador que fue agregado al equipo.....


            //eliminar de tabla player_wts
            $player_wt = PlayerWT::where('person_id',"=",$request->player_id)->delete();

            
        }

        if(sizeof($players) == ($capacity - 1))
        {
            //ver cuando mi equipo esta completo para modificar el complete  ???
            $team = Team::find($request->team_id);
            $team->complete = 1;
            $team->save();
        }

        $person = Person::find($request->player_id);
        return response()->json(array('players' => $players,
            'capacity'=>$capacity, 'person'=>$person));
    }
}
