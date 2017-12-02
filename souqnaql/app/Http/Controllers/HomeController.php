<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Mail\SendMessage;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

        
    public function Call_me_email(Request $request)
    {
        $content = [
            'name' => $request->get('name'),
            'email' => $request->get('email_sender'),
            'user_message' => $request->get('message')
            ];

        $receiverAddress = 'addamahmed011@gmail.com';

        Mail::to($receiverAddress)->send(new SendMessage($content));

        return ('mail send successfully');
    }


}
