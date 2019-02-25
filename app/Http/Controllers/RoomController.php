<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Reservation;
use \App\Room;
use \App\Rekvirent;
use Illuminate\Support\Facades\Auth;


class RoomController extends Controller
{
    public function index() {
        if(Auth::check()){
        $rooms = \App\Room::all()->sortBy('roomid');
        return view('rooms.index', compact('rooms'));
        }
        return redirect('/login');
    }

    public function create()
    {
        return view('/rooms.show'); 
    }

    public function store(Request $request)
    {
        
        $new_reservations = new Reservation();

        $new_reservations->rekvirantid = request('rekvirantid');
        $new_reservations->roomid = request('roomid');
        $new_reservations->dato = request('dato');
        $new_reservations->tid = request('tid');

        $new_reservations->save();

        return redirect('home');

    }

    public function show($roomid) {
        $room = Room::find($roomid);

        $rekvirent = Rekvirent::all();
        $reservations = Reservation::all()->sortBy('tid')->sortBy('dato');

        return view('rooms.show', compact('room', 'reservations', 'rekvirent'));
    }

    public function edit($roomid) { //example.com/projects/1/edit
        if(Auth::check()){
        $room = Room::findOrFail($roomid);
        return view('rooms.edit', compact('room'));
        }
        return redirect('/login');

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $reservation = Reservation::findorfail($id)->delete();
        // Gør det muligt at den sletter fra database.

        return redirect('/home');
    }
}
