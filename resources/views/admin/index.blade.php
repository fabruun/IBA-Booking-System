@extends('layouts.loggedin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Velkommen {{ Auth::user()->uid }}</h3>

            <h5>Rekvirentoversigt</h5>
            @foreach($users as $user)
            <ul>
                <li style="list-style: none;">
                    <a href="/admin/{{ $user->id }}">
                        {{ $user->uid }}</a>
                </li>

            </ul>
            @endforeach
        </div>

    </div>

@endsection
