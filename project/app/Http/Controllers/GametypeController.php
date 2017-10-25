<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\GameType;

class GametypeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    //Muestra todos los Tipos de Juego
    public function index()
    {
    	$gametypes = GameType::all();

    	return view('gametype.index', compact('gametypes'));
    }

    //retorna vista de crear un Tipo de Juego
    public function create()
    {    	
    	return view('gametype.create');
    }

    //método que almacena un nuevo Tipo de Juego en la BD
    public function store(Request $request)
    {
        //validar la petición
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'capacity' => 'required|numeric',
            'duration' => 'required|numeric'
        ]);

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('gametype/create')->withErrors($validator)->withInput();
        }

        //creamos el tipo de juego
        GameType::create([
            'name' => $request['name'],
            'capacity' => $request['capacity'],
            'duration' => $request['duration']
        ]);

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El tipo de juego se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('gametype/index');        
    }

     public function edit(GameType $gametype)
    {
        return view('gametype.edit', compact('gametype'));
    }

    public function update(Request $request, $id)
    {
       //validar la petición
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'capacity' => 'required|numeric',
            'duration' => 'required|numeric'
        ]);

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('gametype/edit')->withErrors($validator)->withInput();
        }

        //Editando tipo de juego
        $gametype = GameType::find($id);
        $gametype->name = $request->name;
        $gametype->capacity = $request->capacity;
        $gametype->duration = $request->duration;

        $gametype->save();

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El tipo de juego se ha editado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('gametype/index');
    }

    public function destroy($gametype)
    {
        GameType::destroy($gametype);

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El Tipo de Juego se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('gametype/index'); 
    }
}
