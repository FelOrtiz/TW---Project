<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\FieldType;

class FieldTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //retorna todos los tipos de canchas
    public function index()
    {
    	$field_types = FieldType::all();

    	return view('fieldtype.index', compact('field_types'));
    }

    //retorna vista de crear tipo de cancha
    public function create()
    {
    	return view('fieldtype.create');
    }

    //método que almacena un nuevo tipo de cancha en la BD
    public function store(Request $request)
    {
     	//validar la petición
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50'
        ]);

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('fieldtype/create')->withErrors($validator)->withInput();
        }

        //creamos la institución
        FieldType::create([
            'name' => $request['name'],
        ]);

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El tipo de cancha se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('fieldtype/index'); 
    }

    public function edit(FieldType $fieldtype)
    {
        return view('fieldtype.edit',compact('fieldtype'));
    }

    public function update(Request $request, $id)
    {
       //validar la petición
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
        ]);

        //si hay fallo, retornar a la vista con los fallos
        if ($validator->fails()) 
        {
            return redirect('fieldtype/edit')->withErrors($validator)->withInput();
        }

        //Editando el Recinto
        $fieldtype = FieldType::find($id);
        $fieldtype->update($request->except ('_token'));


        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El tipo de cancha se ha editado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('fieldtype/index');
    }

    public function delete($id)
    {
    	$fieldtype = FieldType::find($id);
    	$fieldtype->delete();

        //si no hay fallo, retornar mensaje de éxito.
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El tipo de cancha se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('fieldtype/index');
       
    }
}
