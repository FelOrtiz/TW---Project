<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user)
    {
        Log::info($user);
        if($user->role() == 1)
        {
            return view('home');
        }
        
    }
}
