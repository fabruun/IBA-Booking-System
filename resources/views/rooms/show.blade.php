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
                    <h1 class="align-header">Lokale {{ $room->roomid }}</h1>
                    
                    <h5>Reservationer for lokalet</h5>
                    <div class="roomReservations">
                    @foreach ($reservations as $reservation)
                        @if ($room->roomid === $reservation->roomid)
                            <div class="card" style="padding: 20px; list-style: none;">
                                <li><b>Dato: </b> {{ date('d-m-Y', strtotime($reservation->dato)) }}</li>
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
                            @if(Auth::user()->type == 'admin')
                            <select class="field" style="margin-bottom: 1em;" name="rekvirantid">
                                @foreach ($rekvirent as $rekvirent)
                                    <option>{{ $rekvirent->rekvirentid }}</option>
                                @endforeach
                            </select>
                            @else 
                                <input style="margin-bottom: 1em;" type="text" name="rekvirantid" placeholder="roomid" value="{{Auth::user()->uid}}" readonly>
                            @endif
                        </div>
                
                        <div>
                            <input style="margin-bottom: 1em;" type="text" name="roomid" placeholder="roomid" value="{{$room->roomid}}" readonly>
                        </div>
                        
                        <div>
                            <input style="margin-bottom: 1em;" type="date" name="dato">
                        </div>

                        <div>
                            <select name="tid" size="9" style="margin-bottom: 1em">
                                <option value="08:00:00">08:00:00</option>
                                <option value="09:00:00">09:00:00</option>
                                <option value="10:00:00">10:00:00</option>
                                <option value="11:00:00">11:00:00</option>
                                <option value="12:00:00">12:00:00</option>
                                <option value="13:00:00">13:00:00</option>
                                <option value="14:00:00">14:00:00</option>
                                <option value="15:00:00">15:00:00</option>
                                <option value="16:00:00">16:00:00</option>
                            </select> 
                        </div>

                        <div>
                            <button class="btn btn-success" type="submit">Opret reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
