@extends("layouts.loggedin")

@section('content')

            <div class="card">
                <div class="card-body">
                    <h2 class="title">Rekvirentoplysninger</h2>
                    <h5>Bruger: {{ $users->uid }}</h5>
                    <form action="/admin/{{ $users->id }}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="field" style="margin-bottom: 1em;">
                            <label for="name" class="label"><b>Navn:</b></label>
                            <div class="control">
                                <input type="text" class="input" name="name" placeholder="Navn" value="{{ $users->name }}">
                            </div>
                        </div>

                        <div class="field" style="margin-bottom: 1em;">
                            <label for="name" class="label"><b>Email:</b></label>
                            <div class="control">
                                <input type="text" class="input" name="email" placeholder="Email" value="{{ $users->email }}">
                            </div>
                        </div>

                        <div>
                            <div class="control">
                                <button type="submit" class="btn btn-warning">Opdater</button>
                            </div>
                        </div>
                    </form>
                    <form action="/admin/{{ $users->id }}" method="POST" style="margin-top:1em;">
                        @method('DELETE')
                        @csrf
                        <div>
                            <div>
                                <button type="submit" class="btn btn-danger">Slet bruger</button>
                            </div>
                        </div>
                    </form>

                </div>
    </div>

@endsection
