<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Player;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //retorna todos los 
    public function complete()
    {
    	return view('players.playerteam');
    }
}
