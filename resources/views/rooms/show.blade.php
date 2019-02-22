@extends('layouts.loggedin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book et lokale</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="align-header">Lokale {{ $room->roomid }}</h1>
                    
                    <h5>Reservationer for lokalet</h5>
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

                    <h5 style="margin-top: 50px;">Reservér lokalet</h5>
                    <form action="/rooms" method="POST">

                        @csrf

                        <div>
                            <select name="rekvirantid">
                                @foreach ($rekvirent as $rekvirent)
                                    <option>{{ $rekvirent->rekvirentid }}</option>
                                @endforeach
                            </select> 
                        </div>
                
                        <div>
                            <input type="text" name="roomid" placeholder="roomid" value="{{$room->roomid}}" readonly>
                        </div>
                        
                        <div>
                            <input type="date" name="dato">
                        </div>

                        <div>
                            <input type="time" name="tid" value="08:00"> 
                        </div>

                        <div>
                            <button type="submit">Opret reservation</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
