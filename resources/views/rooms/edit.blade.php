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
                            @if(Auth::user()->type == 'admin' || Auth::user()->type == 'teacher')
                            <a href=""><button class="btn btn-primary">Omroker</button></a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h1>Configurator Experimentarium</h1>
                    <p>
                        Take shapes from shape library and place them in room.
                        Draw room with user entered mesurements.
                    </p>
                    <div id='lib'>
                        <canvas id='toolbox' width='250' height='400'></canvas>
                    </div>
                    <div id='work'></div>
                    <div id='spacer'></div>
                    <div>
                        <form id='inputpanel' method='post' action='#' style="margin-top:2em;">
                            <input type='number' name='wid' placeholder='width in cms'/>
                            <input type='number' name='hei' placeholder='height in cms'/>
                            <br/>
                            <button type='button' name='bt1' class="btn btn-primary" style="margin-top:2em;">Create/Recreate Room</button>
                        </form>
                    </div>
                    <div id='calculation'></div>
                </div>
            </div>
        </div>


    </div>

@endsection