<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitation;
use Carbon\Carbon;

class SolicitationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //retorna todas las instituciones y la vista
    public function index()
    {
        Carbon::setlocale('es');
    	$solicitations = Solicitation::all();

        $response = array();

        foreach ($solicitations as $solicitation) 
        {
            $object = array(
                'id' => $solicitation->id,
                'person_name' => $solicitation->person->name(),
                'field_name' => $solicitation->field->name(),
                'date' => Carbon::parse($solicitation->init_hour)->format('d/m/y'),
                'hour' => Carbon::parse($solicitation->init_hour)->format('H:i'),
                'duration' => $solicitation->duration
            );
            array_push($response, $object);            
        }


    	return view('solicitation.index')->with( compact('response'));
    }
}
