@extends('layouts.loggedin')

@section('content')

    <div class="card">
        <div class="card-body">
            <h1 class="title" style="margin:20px;">Lokalenummer {{ $room->roomid }}</h1>
            <ul style="list-style: none;">
                <li><b>Bredde:</b> {{ $room->roomwidth }} mm</li>
                <li><b>Længde:</b> {{ $room->roomlength }} mm</li>
                <li><b>Areal:</b> {{ $room->areasizeofroom }} m<sup>2</sup></li>
                <li><b>Antal personer:</b> {{ $room->personlimit }} personer</li>
            </ul>
            <a href="#"><button class="btn btn-primary">Book lokale</button></a>
        </div>
    </div>




@endsection
