<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reservation;
use App\Booking;

class ReservationController extends Controller
{
    public function index() {

        $reservations = \App\Reservation::all()->sortBy('tid')->sortBy('dato');
        return view('home', compact('reservations'));
      }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }

    public function show() {
        $reservations = Room::findOrFail();
        return view('rooms.show', compact('reservations'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
