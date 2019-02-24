@extends('layouts.loggedin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
                        <div style="margin-top:1em;">
                            <a href="/rooms/{{ $room->id }}"><button class="btn btn-primary" style="margin-right:2em;">Book nu</button></a>
                            <button class="btn btn-primary" id="getUsers" onclick="makeCanvas()">Make Canvas</button>
                        </div>




                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <button id="reset" class="btn btn-primary">Reset</button>
                        <div class="d-flex" style="margin-top:3em;">
                            <canvas id="canvasRoom" width="1200" height="1200" class="justify-content-end"></canvas>
                            <canvas id="toolbox"  style="margin-bottom: 3em; border: 2px solid black;" width="200" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
<script>

    function makeCanvas() {

        //XHR
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '{!! asset('room.json') !!}');
        xhr.onload = function() {
            if(this.status == 200) {
                let room = JSON.parse(this.responseText);
                let canvas = document.getElementById('canvasRoom');
                let ctx = canvas.getContext('2d');
                width = room.roomwidth * 100;
                length = room.roomlength * 100;
                ctx.fillStyle = '#696969';
                ctx.fillRect(0, 0, width, length);

            }
            else if(this.status === 404) {
                document.getElementById('content').innerHTML = "Not found";
            }
        }
        xhr.onerror = function() {
            document.getElementById('content').innerHTML = "Request Error";
        }
        xhr.send();

    }

    function createRooms() {
        let xhr = new XMLHttpRequest();

        xhr.open('GET', '{!! asset('rooms.json') !!}');
        xhr.onload = function() {
            if(this.status === 202) {
                let rooms = JSON.parse(this.responseText);
                let output = '';
                for(let i in rooms) {
                    roomnumber = rooms.roomid[i];
                    width = rooms.roomwidth[i];
                    length = rooms.roomlength[i];
                }
            }
        }
    }

    function makeToolbox() {
        const canvas = document.getElementById('toolbox');
        const ctx = canvas.getContext('2d');
    }

    window.onload = function() {
        makeToolbox();
    }
</script>