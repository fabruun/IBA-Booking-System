@extends('layouts.loggedin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body" id="calelandar-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Lokale {{ $room->roomid }}</h1>
                    <div id="calendar">
                        <h4>Mandag</h4>
                        <div class="day"><a href="#">1/1-2019</a></div>
                        <h4>Tirsdag</h4>
                        <div class="day"><a href="#">2/2-2019</a></div>
                        <h4>Onsdag</h4>
                        <div class="day"><a href="#">3/2-2019</a></div>
                        <h4>Torsdag</h4>
                        <div class="day"><a href="#">4/2-2019</a></div>
                        <h4>Fredag</h4>
                        <div class="day"><a href="#">5/2-2019</a></div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
