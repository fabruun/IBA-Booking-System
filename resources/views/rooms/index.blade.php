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
                <table style="margin:15px;">
                  <h1 style="padding:15px;">Lokaler</h1>
                    @foreach($rooms as $room)

                        <tr>
                            <a style="list-style:none; margin:15px;" href="/rooms/{{ $room->roomid }}">{{ $room->roomid }}</a>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
