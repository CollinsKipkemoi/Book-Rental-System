@extends('layouts.layout')
@section('content')
    <div class="container container-fluid" id="bookByGenre">
        <h3 class="pt-3">Books by genre</h3>
        <h4>{{ $genre }} books in the system</h4>
        <ul>
            @foreach ($books as $book)
                <li>
                    <a href="{{ route('book', ['id' => $book->id]) }}">
                        {{ $book->title }}
                    </a>
                </li>
            @endforeach
        </ul>
        <a class="back" href="/">Back to home</a>
    </div>
@endsection
