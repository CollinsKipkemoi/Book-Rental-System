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
                    <p>Librarian: {{ $rental->librarian->name }}</p>
                @endif
                @if ($rental->status == 'RETURNED')
                    <p>Date of Return: {{ $rental->returned_at }}</p>
                    <p>Librarian: {{ $rental->librarian->name }}</p>
                @endif
                @if ($rental->status == 'ACCEPTED' && $rental->deadline < now())
                    <p class="late">This rental is late.</p>
                @endif
            </div>
        </div>
        <div class="librarian">
            @if (auth()->user()->is_librarian)
                <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="PENDING">PENDING</option>
                        <option value="ACCEPTED">ACCEPTED</option>
                        <option value="REJECTED">REJECTED</option>
                        <option value="RETURNED">RETURNED</option>
                    </select>

                    <label for="deadline">Deadline:</label>
                    <input type="date" id="deadline" name="deadline">

                    <input type="submit" value="Update">
                </form>
            @endif
        </div>
    </div>
@endsection
