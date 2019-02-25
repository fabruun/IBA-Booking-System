<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Reservation;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $users = \App\User::all();
        
        if(Auth::check()){
        return view('home', ['users' => $users]);
    }
        return view('login');
    }

    public function show(){
        if(Auth::check()){
            return view('home');
        }
    }
}
