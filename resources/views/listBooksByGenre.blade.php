@extends('layouts.layout')
@section('content')
    <div class="container container-fluid" id="bookByGenre">
        <h3 class="pt-3">Books by genre</h3>
        <br>
        <h4>{{ $genreName }} books in the system</h4>

        <div class="booksByGenreDiv">
            @foreach ($books as $book)
                <a href="">
                    <li class="bookByGenre">
                        <p><span class="heading">Title: </span>{{ $book->title }}</p>
                        <p><span class="heading">Authors: </span>{{ $book->authors }}</p>
                        <p><span class="heading">Time: </span>{{ $book->created_at }}</p>
                        <p><span class="heading"> Description:</span>{{ $book->description }}</p>
                    </li>
                </a>
            @endforeach
        </div>

        <button class="backHomeBtn">
            <a href="/"> <i class="fa-solid fa-circle-chevron-left"></i> Home</a>
        </button>
    </div>
@endsection
