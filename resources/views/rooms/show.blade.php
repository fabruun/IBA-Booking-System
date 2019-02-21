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
                    <div class="roomReservations">
                    @foreach ($reservations as $reservation)
                        @if ($room->roomid === $reservation->roomid)
                            <div class="card" style="padding: 20px; list-style: none;">
                                <li><b>Dato: </b> {{ $reservation->dato }}</li>
                                <li><b>Tidspunkt: </b> {{ $reservation->tid }}</li>
                                <li><b>Brugernavn: </b> {{ $reservation->rekvirantid }}</li>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
