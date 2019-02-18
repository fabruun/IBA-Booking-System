<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleRoomController extends Controller
{
    public function index($roomid) {
        $room = Room::find($roomid);
        return view('rooms.show', compact('room'));
    }
}
