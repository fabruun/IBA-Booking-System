<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;

class RoomListController extends Controller
{
  public function index() {
    $rooms = \App\Room::all()->sortBy('roomid');
    return view('bookinger.index', compact('rooms'));
  }
}
