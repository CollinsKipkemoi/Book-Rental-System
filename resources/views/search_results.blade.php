@
@extends('layouts.layout')

@section('content')
    <div class="mini-body container container-fluid ">
        <h3>Search Results</h3>

        @foreach ($books as $book)
            <div class="search-result-div">
                <div class="book">
                    <h4>Title: <a href="/">{{ $book->title }}</a></h4>
                    <p>Author: {{ $book->authors }}</p>
                    <p>Date: {{ $book->released_at }}</p>
                    <p>Description: {{ $book->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
