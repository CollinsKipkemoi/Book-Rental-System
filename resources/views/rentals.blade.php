@extends('layouts.layout')

@section('content')
    <div class="myrentals container container-fluid">
        <h2>My Rentals</h2>

        <div class="rentals">
            @foreach (['pendingRentals' => 'Rental Requests (Pending)', 'acceptedRentals' => 'Accepted and In-Time Rentals', 'lateRentals' => 'Late Rentals', 'rejectedRentals' => 'Rejected Rental Requests', 'returnedRentals' => 'Returned Rentals'] as $rentalType => $title)
                <div class="oneRental">
                    <h6>{{ $title }}</h2>
                    @foreach ($$rentalType as $rental)
                        <div class="rental">
                            <a href="{{ route('rental.details', $rental->id) }}">
                                <h3>{{ $rental->book->title }}</h3>
                                <p>Author: {{ $rental->book->author }}</p>
                                <p>Date of Rental: {{ $rental->created_at }}</p>
                                <p>Deadline: {{ $rental->deadline }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
