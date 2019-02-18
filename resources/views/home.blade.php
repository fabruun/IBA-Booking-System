@extends('layouts.loggedin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="#">Bookinger</a>
                        <p style="margin-top: 2em;"><b>Navn: </b>{{(Auth::user()->name)}}</p>
                        <p><b>Email: </b>{{(Auth::user()->email)}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

