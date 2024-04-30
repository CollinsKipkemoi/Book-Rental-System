@extends('layouts.layout')

@section('content')
    <h1>Rental List</h1>

    @foreach (['pendingRentals', 'acceptedRentals', 'lateRentals', 'rejectedRentals', 'returnedRentals'] as $rentalType)
        <h2>{{ ucfirst(str_replace('Rentals', '', $rentalType)) }}</h2>

        @foreach ($$rentalType as $rental)
            <div class="rental-list-item">
                <a href="/">
                    <h3>Title: {{ $rental->book->title }}</h3>
                    <p>Authors: {{ $rental->book->authors }}</p>
                    <p>Date of Rental: {{ $rental->created_at->format('Y-m-d') }}</p>
                    @php
                        $deadline = \Carbon\Carbon::parse($rental->deadline);
                    @endphp
                    <p>Deadline: {{ $deadline ? $deadline->format('Y-m-d') : 'No deadline set' }}</p>
                </a>
            </div>
        @endforeach
    @endforeach
@endsection
