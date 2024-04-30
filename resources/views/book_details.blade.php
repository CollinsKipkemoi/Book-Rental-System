@extends('layouts.layout')

@section('content')
    <div class="book-details container container-fluid ">
        <h3>Book Details</h3>
        <br>
        <div class="outer-div">
            <div class="book-image">
                {{-- TODO: fix the typo for the book url --}}
                <img src="{{ $book->cover_image ?: asset('images/book_cover.png') }}" alt="{{ $book->title }}">
            </div>
            <div class="book-info">
                <h2>{{ $book->title }}</h2>
                <br>
                <p class="author">Authors: {{ $book->authors }}</p>
                {{-- genre --}}
                <p><span class="heading">Genres</span></p>
                <ul>
                    @foreach ($book->genres as $genre)
                        <li>{{ $genre->name }}</li>
                    @endforeach
                </ul>
                {{-- publish date --}}
                <p><span class="heading">Date of publish:</span> {{ $book->released_at }}</p>
                {{-- pages --}}
                <p><span class="heading">Pages: </span>{{ $book->pages }}</p>
                {{-- lang --}}
                <p><span class="heading">Language code:</span> {{ $book->language_code }}</p>
                {{-- isbn --}}
                <p><span class="heading">ISBN Number:</span> {{ $book->isbn }}</p>
                {{-- In stock --}}
                <p><span class="heading">In stock:</span> {{ $book->in_stock }}</p>
                {{-- Description --}}
                <p><span class="heading">Description: </span></p>
                <p>{{ $book->description }}</p>
                <br>
                @if (auth()->check() && !$user->is_librarian && $book->in_stock > 0)
                    <form method="POST" action="{{ route('borrow') }}">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="borrow" {{ $hasOngoingRental ? 'disabled' : '' }}>Borrow
                            Book</button>
                    </form>
                @endif

                {{-- edit book button --}}

                <div class="libBtn">
                    @if (auth()->check() && $user->is_librarian)
                        <form action="{{ route('book_edit', ['bookId' => $book->id]) }}" method="get">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="edit">Edit Book</button>
                        </form>
                    @endif

                    @if (auth()->check() && $user->is_librarian)
                        <form action="{{ route('book_destroy', ['bookId' => $book->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">Delete Book</button>
                        </form>
                    @endif
                </div>



                {{-- TODO: Number of ava --}}
                {{-- TODO: Name of available books (not borrowed) --}}
            </div>

            @if (auth()->check() && !$user->is_librarian)
                <div class="ongoingRentalInfo">
                    <h3>Ongoing Rental Info</h3>
                    <br>
                    @if ($hasOngoingRental)
                        <p>You have an ongoing rental for this book</p>
                    @elseif (!$hasOngoingRental)
                        <p>You do not have an ongoing rental for this book</p>
                    @endif
                </div>
            @endif

        </div>
        <br>
        <a class="back-home" href="/">Back home</a>
    </div>
@endsection
