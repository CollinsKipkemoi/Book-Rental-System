@extends('layouts.layout')

@section('content')
    <div class="create-book container">
        <h3>Add a book to the system</h3>
        <form class="register-form" action="{{ route('book_update', ['bookId' => $book->id]) }}" method="post">
            @csrf
            <div class="mb-4">
                {{-- title --}}
                <label for="title">Book title:</label>
                <br>
                <input value="{{ $book->title }}" type="text" name="title"
                    class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter book title">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                {{-- authors --}}
                <label for="authors">Book authors:</label>
                <br>
                <input type="text" name="authors" value="{{ $book->authors }}"
                    class="form-control @error('authors') is-invalid @enderror" id="authors"
                    placeholder="Enter the book authors">
                @error('authors')
                    <div class="invalid-feedback">
                        {{ $message }} </div>
                    <div class="valid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-4">
                {{-- release date --}}
                <label for="release">Release date:</label>
                <br>
                <input value="{{ $book->released_at }}" type="date" name="released_at"
                    class="form-control @error('release') is-invalid @enderror" id="release"
                    placeholder="Enter your release">
                @error('release')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                {{-- Pages --}}
                <label for="pages">Pages:</label>
                <br>
                <input type="number" name="pages" value="{{ $book->pages }}"
                    class="form-control @error('pages') is-invalid @enderror" id="pages" placeholder="Number of pages">
                @error('pages')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                {{-- ISBN --}}
                <label for="isbn">ISBN:</label>
                <br>
                <input type="text" name="isbn" value="{{ $book->isbn }}"
                    class="form-control @error('isbn') is-invalid @enderror" id="isbn" placeholder="ISBN number">
                @error('isbn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                {{-- Description --}}
                <label for="description">Description:</label>
                <br>
                <textarea name="description" id="description" cols="30" rows="6"
                    class="form-control @error('description') is-invalid @enderror" placeholder="Enter a brief description of the book">{{ $book->description }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                {{-- in stock --}}
                <label for="in_stock">In Stock:</label>
                <br>
                <input type="number" id="in_stock" name="in_stock" min="0" placeholder="Number in stock"
                    value="{{ $book->in_stock }}" class="form-control @error('in_stock') is-invalid @enderror">

                @error('in_stock')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-4">
                {{-- Genres --}}
                <label for="genres">Genres:</label>
                <div class="genre_list">
                    @foreach ($genres as $genre)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="genres[]" id="genre{{ $genre->id }}"
                                value="{{ $genre->id }}">
                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                {{ $genre->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
            <br>
        </form>
    </div>
@endsection
