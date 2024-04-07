<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class brs_controller extends Controller
{
    public function index()
    {
        $rentals = Borrow::where('status', 'ACCEPTED')->count();
        $genreList = Genre::all();
        $users = User::all();
        $books = Book::all();
        // dd($genreList);
        return view('home', [
            'users' => $users,
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
        User::create($validatedData);
        return redirect('/');
    }

    public function listBooksByGenre($genre)
    {
        $books = Book::where('genre', $genre)->get();
        // dd($books);
        return view('listBooksByGenre', ['books' => $books, 'genre' => $genre]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $books = Book::where('title', 'like', "%{$search}%")
            ->orWhere('author', 'like', "%{$search}%")
            ->get();

        return view('search_results', ['books' => $books]);
    }
}
