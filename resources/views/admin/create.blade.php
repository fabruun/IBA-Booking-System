@extends("layouts.loggedin")

@section('content')
    <form method="POST" action="/admin">

        {{ csrf_field() }}

        <div>
            <input type="text" name="rekvirent" placeholder="Rekvirent">
        </div>

        <div>
            <button type="submit">Opret rekvirent</button>
        </div>
    </form>
@endsection
