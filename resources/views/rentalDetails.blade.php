@extends('layouts.layout')

@section('content')
    <div class="rental-details container container-fluid">
        <h1>Rental Details</h1>

        <div class="outerRentals">
            <div class="book-details">
                <div class="book-details-inner">
                    <h2>Book</h2>
                    <br>
                    <a href="/">
                        <p>Title: {{ $rental->book->title }}</p>
                        <br>
                        <p>Author: {{ $rental->book->author }}</p>
                        <br>
                        <p>Date: {{ $rental->book->date }}</p>
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
    </div>
@endsection
