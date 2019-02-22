@extends('layouts.loggedin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin</div>
                <div class="card-body">
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
        </div>
    </div>
</div>
@endsection
