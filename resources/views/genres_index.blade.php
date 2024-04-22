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
                        <div class="genreAndStyle">
                            <h4 class="genreName">Name: {{ $genre->name }}</h4>
                            <p class="genreStyle">Style: {{ $genre->style }}</p>
                        </div>
                        <div class="genreButtons">

                            <button type="submit" class="edit">
                                <a href="{{route('genre_edit', ['genreId' => $genre->id])}}"><i class="fa-solid fa-pencil"></i> Edit</a>
                            </button>

                            <form
                                action="{{ route('genre_destroy', [
                                    'genreId' => $genre->id,
                                ]) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
