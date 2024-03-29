@extends('layouts.layout')

@section('content')
    <div class="home-div container">
        <h1>Welcome to BRS</h1>
        <br>
        <div class="details-div">
            <div class="users">
                <h2>Users</h2>
                <p>{{$users}}</p>
            </div>
            <div class="genres">
                <h2>Number of genres</h2>
                <p>
                    {{$genres}}
                </p>
            </div>
            <div class="books">
                <h2>Number of books</h2>
                <p>
                    {{$books}}
                </p>
            </div>
{{--            active book rentals --}}
            <div class="rentals">
                <h2>Active book rentals</h2>
                <p>
                    {{$rentals}}
                </p>
            </div>
        </div>
        <br>
        <br>
        <div class="genre-list">
            <h2>Genre list</h2>
            <ol>
                @foreach($genrelist as $genre)
                    <li>
                        <a href="#">{{$genre}}</a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
