@extends('layouts.layout')

@section('content')
    <div class="book-details container container-fluid ">
        <h3>Book Details</h3>
        <br>
        <div class="outer-div">
            <div class="book-image">
                {{-- TODO: fix the typo for the book url --}}
                <img src="{{ $book->cover_imag ?: asset('images/book_cover.png') }}" alt="{{ $book->title }}" height="90%">
            </div>
            <div class="book-info">
                <h2>{{ $book->title }}</h2>
                <br>
                <p class="author">{{ $book->authors }}</p>
                {{-- genre --}}
                <p>Genre: {{ $book->genre }}</p>
                {{-- publish date --}}
                <p>Date of publish: {{ $book->released_at }}</p>
                {{-- pages --}}
                <p>Pages: {{ $book->pages }}</p>
                {{-- lang --}}
                <p>Language code: {{ $book->language_code }}</p>
                {{-- isbn --}}
                <p>ISBN Number: {{ $book->isbn }}</p>
                {{-- In stock --}}
                <p>In stock: {{ $book->in_stock }}</p>
                {{-- Description --}}
                <br>
                <p>{{ $book->description }}</p>

                {{-- TODO: Name of available books (not borrowed) --}}
            </div>
        </div>
        <br>
        <a class="back-home" href="/">Back home</a>
    </div>
@endsection