@extends('layouts.layout')

@section('content')
    <div class="mini-body container container-fluid ">
        <h3>Search Results</h3>

        @foreach ($books as $book)
            <a href="{{ route('books.show', ['id' => $book->id]) }}">
                <div class="search-result-div">
                    <div class="book">
                        <h4>Title:{{ $book->title }}</h4>
                        <p>Author: {{ $book->authors }}</p>
                        <p>Date: {{ $book->released_at }}</p>
                        <p>Description: {{ $book->description }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
