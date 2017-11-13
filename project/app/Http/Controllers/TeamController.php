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

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //retorna todos los recintos
    public function index()
    {
    	$teams = Team::all();

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

    //método que almacena un nuevo recinto en la BD
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

        //creamos la institución
        Team::create([
            'responsible_id' => auth()->user()->id,
            'gametype_id' => $request['city_id'],
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
}
