@extends('layouts.layout')

@section('content')
    <div class="rental-details container container-fluid">
        <h1>Rental Details</h1>

        <div class="outerRentals">
            <div class="book-details">
                <div class="book-details-inner">
                    <h2>Book</h2>
                    <br>
                    <a href="{{ route('books.show', $rental->book->id) }}">
                        <p>Title: {{ $rental->book->title }}</p>
                        <br>
                        <p>Author: {{ $rental->book->authors }}</p>
                        <br>
                    <p>Date: {{ $rental->book->created_at }}</p>
                    </a>
                </div>
            </div>

            <div class="rental-data">
                <h2>Rental Data</h2>
                <p>Borrower: {{ $rental->reader->name }}</p>
                <p>Date of Rental Request: {{ $rental->created_at }}</p>
                <p>Status: {{ $rental->status }}</p>
                @if ($rental->status != 'PENDING')
                    <p>Date of Procession: {{ $rental->request_processed_at }}</p>
                    <p>Librarian: {{ auth()->user()->name }}</p>
                @endif
                @if ($rental->status == 'RETURNED')
                    <p>Date of Return: {{ $rental->returned_at }}</p>
                    <p>Librarian: {{ auth()->user()->name }}</p>
        
                @endif
                @if ($rental->status == 'ACCEPTED' && $rental->deadline < now())
                    <p class="late">This rental is late.</p>
                @endif
                @if (auth()->user()->is_librarian)
                    <form action="{{ route('rental.update', $rental->id) }}" method="POST" class="librarian-rental-details">
                        @csrf
                        @method('PUT')

                        <label for="status">Status:</label>
                        <select name="status" id="status">
                            <option value="PENDING" {{ old('status', $rental->status) == 'PENDING' ? 'selected' : '' }}>
                                PENDING</option>
                            <option value="ACCEPTED" {{ old('status', $rental->status) == 'ACCEPTED' ? 'selected' : '' }}>
                                ACCEPTED</option>
                            <option value="REJECTED" {{ old('status', $rental->status) == 'REJECTED' ? 'selected' : '' }}>
                                REJECTED</option>
                            <option value="RETURNED" {{ old('status', $rental->status) == 'RETURNED' ? 'selected' : '' }}>
                                RETURNED</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <label for="deadline">Deadline:</label>
                        <input type="date" id="deadline" name="deadline"
                            value="{{ old('deadline', $rental->deadline ? \Carbon\Carbon::parse($rental->deadline)->format('Y-m-d') : '') }}">
                        @error('deadline')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input type="submit" value="Update">
                    </form>
                @endif
            </div>
        </div>

    </div>
@endsection
