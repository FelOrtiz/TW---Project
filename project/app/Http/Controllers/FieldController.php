<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Field;
use App\Enclosure;
use App\FieldType;
use Carbon\Carbon;

class FieldController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$fields = Field::all();

    	return view('field.index', compact('fields'));
    }

    public function create()
    {
    	$enclosures = Enclosure::all();
    	$fieldtype = FieldType::all();

    	return view('field.create', compact('enclosures', 'fieldtype'));
    }

    public function store(Request $request)
    {
    	//validar la petición
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|string|min:3|max:50',
    		'enclosure_id' => 'required|numeric',
    		'capacity' => 'required|integer',
    		'type_id' => 'required|numeric',
    		'init_hour' => 'required|date_format:H:i',
    		'end_hour' => 'required|date_format:H:i'
    	]); 

    	//si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('field/create')->withErrors($validator)->withInput();
        }

        //creamos la cancha
        Field::create([
        	'name' => $request['name'],
        	'enclosure_id' => $request['enclosure_id'],
        	'capacity' => $request['capacity'],
        	'type_id' => $request['type_id'],
        	'init_hour' => Carbon::parse('now')->modify($request['init_hour']),
        	'end_hour' => Carbon::parse('now')->modify($request['end_hour'])
        ]);

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La cancha se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('field/index'); 
    }

    public function edit(Field $field)
    {
    	$enclosures = Enclosure::all();
    	$fieldtype = FieldType::all();

    	return view('field.edit', compact('field','enclosures','fieldtype'));
    }

    public function update(Request $request, $id)
    {
    	//validar la petición
    	$validator = Validator::make($request->all(),[
    		'name' => 'required|string|min:3|max:50',
    		'enclosure_id' => 'required|numeric',
    		'capacity' => 'required|integer',
    		'type_id' => 'required|numeric',
    		'init_hour' => 'required|date_format:Y-m-d H:i:s',
    		'end_hour' => 'required|date_format:Y-m-d H:i:s'
    	]); 

    	//si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('field/create')->withErrors($validator)->withInput();
        }
        
        //Editar la cancha
        $field = Field::find($id);
        $field->update($request->except ('_token'));


        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La cancha se ha editado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('field/index');	
    }

    public function delete(Field $field)
    {
    	$field->delete();

    	session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La cancha se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('field/index');
    }

}
