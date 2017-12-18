<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	
        $notifications = Notification::where('person_id',"=",auth()->user()->id)->get();

    	return view('notification.index', compact('notifications'));
    }

    public function update(Request $request)
    {
    	$notification = Notification::find($request->notification_id);
    	$notification->viewed = 1;
    	$notification->save();

     	return response()->json(array('info' => $notification->info));
    }

    public function view(Request $request)
    {
    	$notification = Notification::find($request->notification_id);
    	$notification->viewed = 1;
    	$notification->save();

     	return response()->json(array('true' => true));
    }
    
}
