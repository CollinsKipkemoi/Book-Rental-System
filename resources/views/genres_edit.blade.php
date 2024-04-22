@extends('layouts.layout')

@section('content')
    <div class="mini-body container container-fluid ">
        <h3 class="mt-3">Edit genre</h3>
        <br>
        <form action="{{ route('genres_update', ["genreId" => $genre->id]) }}" method="post">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ $genre->name }}" class="newGenre">
            <select name="style">
                <option value="">Select style</option>
                <option value="primary">Primary</option>
                <option value="secondary">Secondary</option>
                <option value="success">Success</option>
                <option value="danger">Danger</option>
                <option value="warning">Warning</option>
                <option value="info">Info</option>
                <option value="light">Light</option>
                <option value="dark">Dark</option>
            </select>
            <button type="submit" class="addGenre">Edit genre</button>
        </form>



    </div>
@endsection
