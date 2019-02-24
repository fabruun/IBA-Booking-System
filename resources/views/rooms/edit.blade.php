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
                            <button class="btn btn-primary" id="getUsers" onclick="setup()">Make Canvas</button>
                        </div>




                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <button id="reset" class="btn btn-primary" onclick="reset()">Reset</button>
                        <button id="reset" class="btn btn-primary" onclick="standard()">Standard indstillinger</button>
                        <div class="d-flex" style="margin-top:3em;">
                            <canvas id="canvasRoom" width="1200" height="1200" class="justify-content-end"></canvas>
                           <div id="toolbox"style="height: 600px; width: 300px" ></div>
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
            if(this.status === 200) {
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

    function reset() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '{!! asset('room.json') !!}');
        xhr.onload = function() {
            if(this.status === 200) {
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

    function standard() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '{!! asset('room.json') !!}');
        xhr.onload = function() {
            if(this.status === 200) {
                let room = JSON.parse(this.responseText);
                let canvas = document.getElementById('canvasRoom');
                let ctx = canvas.getContext('2d');
                width = room.roomwidth * 100;
                length = room.roomlength * 100;
                ctx.fillStyle = '#696969';
                ctx.fillRect(0, 0, width, length);
                ctx.fillStyle = 'black';
                ctx.fillRect(100, 100, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(300, 100, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(500, 100, 100, 100);
                ctx.fillRect(100, 300, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(300, 300, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(500, 300, 100, 100);
                ctx.fillRect(100, 500, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(300, 500, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(500, 500, 100, 100);

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

    function toolbox() {
        // create toolbox canvas object
        let body = document.getElementById('toolbox');
        let toolbox = document.createElement('canvas');
        toolbox.setAttribute('id', 'toolboxCanvas');
        body.appendChild(toolbox);
        document.getElementById('toolboxCanvas').style.width = '300';
        document.getElementById('toolboxCanvas').style.height = '600';
        let ctx = toolbox.getContext('2d');
        ctx.strokeStyle = 'black';
        ctx.strokeRect(0, 0, 300, 600);

        ctx.fillStyle = 'black';
        ctx.fillRect(50, 50, 150, 150);
    }



    setup = function() {
        makeCanvas();
        toolbox();
    }
</script>