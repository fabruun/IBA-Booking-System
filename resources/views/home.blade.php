@extends('layouts.loggedin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>Velkommen {{(Auth::user()->name)}}!</h2>

                    <div class="profile_info">
                        <h4 style="margin-top: 2em;">Dine informationer:</h4>
                        <p><b>Brugernavn: </b>{{(Auth::user()->uid)}}</p>
                        <p><b>Navn: </b>{{(Auth::user()->name)}}</p>
                        <p><b>Email: </b>{{(Auth::user()->email)}}</p>
                    </div>

                    <div class="personal_bookings">
                        <h4 style="margin-top: 2em;">Dine reservationer:</h4>

                    <div class="roomReservations">
                        @foreach ($reservations as $reservation)
                            @if ((Auth::user()->uid) === $reservation->rekvirantid)
                            
                                <div class="card" style="list-style: none; padding: 20px;">
                                <form class="delete-form" method="post" action="rooms/{{$reservation->id}}">
                                        @method('DELETE')
                                        @csrf
                                        <button title="Slet reservation" class="btn btn-danger" type="submit">x</button>
                                    </form>
                                    <li><b>Dato:</b> {{ date('d-m-Y', strtotime($reservation->dato)) }}</li>
                                    <li><b>Tid:</b> {{ $reservation->tid }}</li>
                                    <li><b>Brugernavn:</b> {{ $reservation->rekvirantid }}</li>
                                    <li><b>Lokale:</b> {{ $reservation->roomid }}</li>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
