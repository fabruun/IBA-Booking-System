@extends('layouts.loggedin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div style="margin:15px;">
                        <div class="card" style="width:18em; list-style:none; padding:15px;">
                            <h1 style="padding:15px;">Lokale {{ $room->roomid }}</h1>
                            <li><b>Bredde:</b> {{ $room->roomwidth }} mm</li>
                            <li><b>Længde:</b> {{ $room->roomlength }} mm</li>
                            <li><b>Areal:</b> {{ $room->areasizeofroom }} m<sup>2</sup> </li>
                            <li><b>Antal:</b> {{ $room->personlimit }}</li>
                        </div>
                        <div style="margin-top:1em; margin-bottom: 1em;">
                            <a href="/rooms/{{ $room->id }}"><button class="btn btn-primary" style="margin-right:2em;">Book nu</button></a>
                            <button class="btn btn-primary" id="getUsers" onclick="getUser()">Get Room</button>
                            <button class="btn btn-primary" id="getUsers" onclick="getUsers()">Get Rooms</button>
                            <button id="button" class="btn btn-danger">Say Hello</button>
                        </div>
                        <div id="hello"></div>
                        <canvas id="canvasRoom"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    function getUser() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '{!! asset('room.json') !!}');
        xhr.onload = function () {
            if(this.status === 200) {
                let user = JSON.parse(this.responseText);
                let output = '';
                output += '<ul style="list-style: none;">' +
                        '<li>'+user.roomid+'</li>' +
                        '<li>'+user.roomwidth+'</li>' +
                        '<li>'+user.roomlength+'</li>' +
                        '</ul>';
                document.getElementById('hello').innerHTML = output;
            }
        }
        xhr.send();
    }

    function getUsers() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '{!! asset('rooms.json') !!}');
        xhr.onload = function () {
            if(this.status === 200) {
                let users = JSON.parse(this.responseText);
                let output = '';
                for(let i in users) {
                    output += '<ul style="list-style: none;">' +
                        '<li>' + users.roomid[i] + '</li>' +
                        '<li>' + users.roomwidth[i] + '</li>' +
                        '<li>' + users.roomlength[i] + '</li>' +
                        '</ul>';
                }
                document.getElementById('hello').innerHTML = output;
            }
        }
        xhr.send();
    }

window.onload = function() {
        getUser;
        getUsers;
}
</script>