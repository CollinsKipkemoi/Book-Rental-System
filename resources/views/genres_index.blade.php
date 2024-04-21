@extends('layouts.layout')


@section('content')
    <div class="mini-body container container-fluid ">

        <h3 class="mt-3">Genre list</h3>
        <br>
        <button type="submit" class="addGenre mb-5">
            <a href="{{ route('genres_create') }}"><i class="fa-solid fa-plus"></i> Add a new genre</a>
        </button>
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
