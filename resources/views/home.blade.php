@extends('layouts.layout')

@section('content')
    <div class="home-div container">
        <div class="welcome-search">
            <h3>Welcome to BookBorrowHub</h3>
            <form action="{{route('books.search')}}" method="GET">
                <input type="text" name="search" placeholder="Enter book title or author">
                <button type="submit">Search</button>
            </form>
        </div>
        <br>
        <div class="details-div">
            <div class="users">
                <h4>Users</h4>
                <p>{{ count($users) }}</p>
            </div>
            <div class="genres">
                <h4>Number of genres</h4>
                <p>
                    {{ count($genrelist) }}
                </p>
            </div>
            <div class="books">
                <h4>Number of books</h4>
                <p>
                    {{ count($books) }}
                </p>
            </div>
            {{--            active book rentals --}}
            <div class="activeRentals">
                <h4>Active book rentals</h4>
                <p>
                    {{ $rentals }}
                </p>
            </div>
        </div>
        <br>
        <br>
        <div class="genre-list">
            <h4>Genre list</h4>
            <ol>
                @foreach ($genrelist as $genre)
                    <li>
                        <a href="{{ route('books.genre', ['genre' => $genre->name]) }}">{{ $genre->name }}</a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
