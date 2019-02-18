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
                        <h1>Lokale {{ $room->roomid }}</h1>
                            <div class="d-flex justify-content-md-between text-center">
                                <div class="card" style="width:7em; height: 5em;">1</div>
                                <div class="card" style="width:7em; height: 5em;">2</div>
                                <div class="card" style="width:7em; height: 5em;">3</div>
                                <div class="card" style="width:7em; height: 5em;">4</div>
                                <div class="card" style="width:7em; height: 5em;">5</div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
