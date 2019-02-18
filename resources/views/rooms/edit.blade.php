@extends('layouts.loggedin')

@section('content')

    <h1 class="title">Edit Project</h1>

    <form method="POST" action="/projects/{{ $room->roomid }}">

    {{ method_field('PATCH') }} <!-- This way we can sneak in a PATCH request -->

        {{ csrf_field() }}
        <div class="field">

            <label for="title" class="label">Title</label>

            <div class="control">

                <input type="text" class="input" name="title" placeholder="Title" value="{{ $room->roomlength }}">

            </div>


        </div>

        <div class="field">

            <label for="" class="label">Description</label>

            <div class="control">

                <textarea name="description" class="textarea" >{{ $room->roomwidth }}</textarea>

            </div>


        </div>

        <div class="field">

            <div class="control">

                <button type="submit" class="button-is-link">Update Project</button>

            </div>


        </div>



    </form>

@endsection
