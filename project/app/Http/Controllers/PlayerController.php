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

    public searchTeam()
    {
    	
    }
}
