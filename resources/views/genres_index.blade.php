@extends('layouts.layout')


@section('content')
    <div class="mini-body container container-fluid ">

        <h3 class="mt-3">Genres</h3>
        <br>
        <div class="genre-list">
            <ol>
                @foreach ($genres as $genre)
                    <li class="genre">
                        <h4 class="genreName">Name: {{ $genre->name }}</h4>
                        <p class="genreStyle">Style: {{ $genre->style }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
