@extends('layouts.loggedin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Velkommen {{ Auth::user()->uid }}</h3>

            <h5>Rekvirentoversigt</h5>
            @foreach($rekvirents as $rekvirents)
            <ul>
                <li style="list-style: none;">
                    <a href="/admin/{{ $rekvirents->id }}/edit">
                        {{ $rekvirents->rekvirentid }}</a>
                </li>

            </ul>
            @endforeach
        </div>

    </div>

@endsection
