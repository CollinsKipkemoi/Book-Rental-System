<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class brs_controller extends Controller
{
    public function index()
    {
        $users = 42;
        $genres = 12;
        $books = 100;
        $rentals = 50;
        $genreList = [
            'Fiksi', 'Non-Fiksi', 'Horror', 'Romance', 'Sci-Fi', 'Fantasy', 'Mystery', 'Thriller', 'Biography', 'History', 'Science', 'Cooking'
        ];
        return view('home', [
            'users' => $users,
            'genres' => $genres,
            'books' => $books,
            'rentals' => $rentals,
            'genrelist' => $genreList
        ]);
    }

    public function create()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.sign-in');
    }

    public function store(Request $request)
    {
//        dd($request);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

//        $user = new User;
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->password = $request->password;
//        $user->save();
//        return redirect('/')->with('status', 'Data User Berhasil Ditambahkan!');
        return redirect('/');
    }
}
