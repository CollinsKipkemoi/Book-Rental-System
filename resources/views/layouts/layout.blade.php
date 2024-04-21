<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="icon" href="{{ asset('images/book.png') }}">
    <title>BRS SYSTEM</title>
</head>

<body>
    <div class="navbar-div-wrapper">
        <nav class="navbar navbar-expand-md bg-body-tertiary container container-fluid" id="nav-container">
            <a class="navbar-brand" href="/">BRS</a>
            <div class="nav-items-div">
                <ul>
                    @auth
                        <li><a href="/">Home</a></li>
                        {{-- view active rentals --}}
                        <li><a href="/rentals">My Rentals</a></li>
                        @if (auth()->user()->is_librarian)
                            {{-- view all rentals --}}
                            <li><a href="">Rental details</a></li>
                            {{-- view all books --}}
                            <li><a href="/books">All Books</a></li>
                            <li>
                                <a href="/addBook">create book</a>
                            </li>
                            <li>
                                <a href="{{ route('genres_index') }}">Genre List</a>
                            </li>
                        @endif
                    @endauth
                    @guest
                        <li><a href="/create">Register</a></li>
                        <li><a href="/login">Login</a></li>
                    @endguest
                    {{-- create a book --}}

                    <div class="profile">
                        <a href="/profile">
                            <img src="{{ asset('images/profile.png') }}" alt="user" class="user-icon">
                        </a>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container body">
        @yield('content')
        <br>
        <br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0c0bb61621.js" crossorigin="anonymous"></script>
</body>

</html>
