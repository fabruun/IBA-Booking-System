@extends("layouts.loggedin")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin</div>
                <div class="card-body">
                    <h2 class="title">Rekvirentoplysninger</h2>
                    <div class="content">
                        <p>{{ $user->uid }}</p>
                        <p>{{ $user->name }}</p>
                        <p>{{ $user->email }}</p>
                    </div>
                    <a href="/admin/{{ $user->id }}/edit">Rediger bruger</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
