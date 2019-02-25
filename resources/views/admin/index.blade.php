@extends('layouts.loggedin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                
                    <h5 style="margin-top: 50px;">Opret brugernavn</h5>
                    
                    <form action="/admin" method="post">
                        @csrf

                        <div>
                            <input type="text" name="rekvirentid" placeholder="Indsæt brugernavn">
                        </div>

                        <div>
                            <button style="margin-top: .5em;" class="btn btn-success" type="submit">Opret brugernavn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
