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
    	$fieldtypes = FieldType::all();

    	return view('fieldtype.index', compact('fieldtypes'));
    }

    //retorna vista de crear tipo de cancha
    public function create()
    {
    
    }

    //método que almacena un nuevo tipo de cancha en la BD
    public function store(Request $request)
    {
     
    }

    public function edit(FieldType $fieldtype)
    {
        
    }

    public function update(Request $request, $id)
    {
       
    }

    public function destroy($fieldtype)
    {
       
    }
    
}
