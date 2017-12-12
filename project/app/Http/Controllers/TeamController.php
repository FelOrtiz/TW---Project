<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Team;
use App\Person;
use App\City;
use App\GameType;
use App\PlayerWT;
use App\Player;
use App\Enclosure;
use App\Match;
use App\Solicitation;
use App\Field;

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
        Team::create([
            'responsible_id' => auth()->user()->id,
            'game_type_id' => $request['gametype_id'],
            'complete' => 0,
            'city_id' => $request['city_id'],
            'init_hour' => Carbon::parse('now')->modify($request['init_hour'])
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

    public function search_opponent(Request $request)
    {
        $team = Team::find($request['team_id']);

        $msg = null;
        if(!$team->match_found)
        { 
            if(!$team->searching)
            {
                $team->searching = true;
                $team->save();
            }

            $teams = Team::where('searching', true)->where('id', '!=', $team->id)->get();
            

            foreach ($teams as $opp_team) 
            {
                if($opp_team->responsible->city->id == $team->responsible->city->id &&
                    $opp_team->game_type->id == $team->game_type->id &&
                    $opp_team->init_hour == $team->init_hour &&
                    $opp_team->searching && $team->searching)
                {
                    //match found!!
                    //DB::beginTransaction();

                    $team->searching = false;
                    $team->save();
                    $opp_team->searching = false;
                    $opp_team->save();

                    //return \Response::json($opp_team);

                    $enclosures = Enclosure::where('city_id', $team->responsible->city_id)->get();

                    $enclosure = null;
                    foreach ($enclosures as $enc) 
                    {
                        if($enc->fields->count() > 0)
                        {
                            $enclosure = $enc;
                        }
                    }

                    if($enclosure != null)
                    {
                        $field = $enclosure->fields->first();

                        if($field != null)
                        {
                            $opp_team->match_found = true;
                            $opp_team->save();

                            $team->match_found = true;
                            $team->save();

                            $solicitation = Solicitation::create([
                                'person_id' => $team->responsible_id,
                                'field_id' => $field->id,
                                'init_hour' => $team->init_hour,
                                'duration' => $team->game_type->duration
                            ]);

                            Match::create([
                                'v_team_id' => $opp_team->id,
                                'l_team_id' => $team->id,
                                'solicitation_id' => $solicitation->id
                            ]);


                            //DB::commit();
                            $msg = "Oponente encontrado!";
                        }
                        else
                        {
                            //DB::rollBack();
                            $msg = "No existe un campo en el horario y ciudad seleccionados.";
                        }
                    }
                    else
                    {
                        //DB::rollBack();
                        $msg = "No existen canchas en la ciudad seleccionada.";
                    }
                }
                else
                {
                    //DB::rollBack();
                    $msg = "not found";
                }
            }
        }
        else
        {
            $msg = "Solicitud realizada exitosamente.";
        }

        return \Response::json($msg);
    }

    public function cancel_search_opponent(Request $request)
    {
        $team = Team::find($request['team_id']);

        $team->searching = false;
        $team->save();

        return \Response::json($team);
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
        $capacity = ($gametype->capacity)/2 ;

        if (sizeof($players) < $capacity ){
            
            //agregar a mi equipo
            Player::create([
                'person_rut' => $request->player_id,
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
