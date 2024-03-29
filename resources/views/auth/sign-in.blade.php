<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/auth.css">
    <title>SignIn</title>
</head>
<body>
<div class="row container-div">
    <div class="col-md -7 col-xl-8 div1">
        <img src="./images/animated-study-2.png" width="300px">
        <br>
        <h1>BookWise Rentals
        </h1>
        <h5>
            Login to get started
        </h5>

    </div>
    <div class="col-md-5 col-xl-4 div2">
        <br>
        <br>
        <h3>Login</h3>
        <br>
        <form class="register-form" action="" method="post">
            @csrf
            <div class="mb-4">
                {{-- email --}}
                <label for="email">Email</label>
                <br>
                <input type="email" name="email"
                       value="{{old('email')}}"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email" placeholder="Enter your email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }} </div>
                @enderror

            </div>
            <div class="mb-4">
                {{-- password --}}
                <label for="password">Password</label>
                <br>
                <input value="{{old('password')}}" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password" placeholder="Enter your password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <br>
            <br>
            <a href="/create">Don't have an account? Register</a>
        </form>


    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</body>
</html>
