<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Person;
use App\Institution;

class InstitutionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //retorna todas las instituciones y la vista
    public function index()
    {
    	$institutions = Institution::all();

    	return view('institution.index', compact('institutions'));
    }

    //retorna vista de crear una institución
    public function create()
    {
    	$people = Person::all(); //para el select
    	
    	return view('institution.create', compact('people'));
    }

    //método que almacena una nueva institución en la BD
    public function store(Request $request)
    {
        //validar la petición
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'id' => 'required|numeric|exists:people'
        ]);

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('institution/create')->withErrors($validator)->withInput();
        }

        //creamos la institución
        Institution::create([
            'name' => $request['name'],
            'responsible_id' => $request['id']
        ]);

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La institución se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('institution/index');        
    }
}
