@extends('layouts.layout')

@section('content')
    <div class="profileContainer container container-fluid">
        <div class="profileInfo">
            <div class="profileImg">
                <img src="{{ asset('images/profile.png') }}" alt="user" class="user-icon">
            </div>
            <div class="profileDetails">
                <p>Name: {{ auth()->user()->name }}</p>
                <p>Email: {{ auth()->user()->email }}</p>
                <p>Role: {{ auth()->user()->is_librarian ? 'Librarian' : 'User' }}</p>
            </div>
        </div>
        <button class="profileBtn">
            <a href="/"> <i class="fa-solid fa-circle-chevron-left"></i> Home</a>
        </button>
    </div>
@endsection

