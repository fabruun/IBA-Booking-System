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
                            <button class="btn btn-primary" id="createRoom" onclick="draw()">Omroker</button>
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
@include('footervarview')
<script>
    'use strict';
    /*function draw() {
        let canvas = document.getElementById('canvasRoom');
        if (canvas.getContext) {
            let ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
    }*/
    console.log(testname);
</script>