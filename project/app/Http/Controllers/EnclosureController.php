<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Enclosure;
use App\Person;
use App\City;
use App\Institution;

class EnclosureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //retorna todos los recintos
    public function index()
    {
    	$enclosures = Enclosure::all();

    	return view('enclosure.index', compact('enclosures'));
    }

    //retorna vista de crear un Recinto
    public function create()
    {
        $people = Person::all(); //para el select
        $cities = City::all();
        $institutions = Institution::all();

        return view('enclosure.create', compact('people','cities','institutions'));
    }

    //método que almacena un nuevo recinto en la BD
    public function store(Request $request)
    {
        //validar la petición
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'address' => 'required|string|min:3|max:50',
            'responsible_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'institution_id' => 'required|numeric'
        ]);

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('enclosure/create')->withErrors($validator)->withInput();
        }

        //creamos la institución
        Enclosure::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'responsible_id' => $request['responsible_id'],
            'city_id' => $request['city_id'],
            'institution_id' => $request['institution_id']
        ]);

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El recinto se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('enclosure/index');        
    }

    public function edit(Enclosure $enclosure)
    {
        $people = Person::all(); //para el select
        $cities = City::all();
        $institutions = Institution::all();
        return view('enclosure.edit', compact('enclosure','people','cities','institutions'));
    }

    public function update(Request $request, $id)
    {
       //validar la petición
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'address' => 'required|string|min:3|max:50',
            'responsible_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'institution_id' => 'required|numeric'
        ]);

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('enclosure/edit')->withErrors($validator)->withInput();
        }

        //Editando el Recinto
        $enclosure = Enclosure::find($id);
        $enclosure->update($request->except ('_token'));


        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El recinto se ha editado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('enclosure/index');
    }

    public function delete(Enclosure $enclosure)
    {
        $enclosure->delete();

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El recinto se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('enclosure/index'); 
    }
    
}
