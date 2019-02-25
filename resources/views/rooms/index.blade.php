@extends('layouts.loggedin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Book et lokale</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <h1 style="padding:15px;">Lokaler</h1>
                <div class="roomReservations">
                    @foreach($rooms as $room)
                        <div class="card" style="margin: 10px; padding:1em; text-align: center;">
                            <a style="list-style:none; margin:15px;" href="/rooms/{{ $room->id }}/edit">{{ $room->roomid }}</a>
                            <li style="list-style: none; ">{{ $room->personlimit }} personer</li>
                        </div>      
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
