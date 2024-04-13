<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = User::create($validatedData);
        Auth::login($user);
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
    public function show($id)
    {
        $book = Book::find($id);

        return view('book_details', ['book' => $book]);
    }

    // borrow
    public function borrowBook(Request $request)
    {
        $book = Book::find($request->book_id);
        if ($book->in_stock > 0) {
            $borrow = new Borrow();
            $borrow->reader_id = auth()->user()->id;
            $borrow->book_id = $book->id;
            $borrow->status = 'PENDING';
            $borrow->save();

            $book->in_stock -= 1;
            $book->save();

            return redirect()->route('rentals')->with('success', 'Book borrowed successfully');
        } else {
            return redirect()->route('rentals')->with('error', 'Book is not in stock');
        }
    }

    // show rentals
    public function showRentals()
    {
        $pendingRentals = Borrow::where('reader_id', auth()->user()->id)
            ->where('status', 'PENDING')
            ->get();

        $acceptedRentals = Borrow::where('reader_id', auth()->user()->id)
            ->where('status', 'ACCEPTED')
            ->where('deadline', '>=', now())
            ->get();

        $lateRentals = Borrow::where('reader_id', auth()->user()->id)
            ->where('status', 'ACCEPTED')
            ->where('deadline', '<', now())
            ->get();

        $rejectedRentals = Borrow::where('reader_id', auth()->user()->id)
            ->where('status', 'REJECTED')
            ->get();

        $returnedRentals = Borrow::where('reader_id', auth()->user()->id)
            ->where('status', 'RETURNED')
            ->get();

        return view('rentals', [
            'pendingRentals' => $pendingRentals,
            'acceptedRentals' => $acceptedRentals,
            'lateRentals' => $lateRentals,
            'rejectedRentals' => $rejectedRentals,
            'returnedRentals' => $returnedRentals,
        ]);
    }

    // show rental details

    // create a book
    public function addBook()
    {
        $genres = Genre::all();
        return view('create_book', [
            'genres' => $genres

        ]);
    }

    public function store_book(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'authors' => 'required|max:255',
            'released_at' => 'required|date|before:now',
            'pages' => 'required|integer|min:1',
            'isbn' => ['required', 'regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i'],
            'description' => 'nullable',
            'genres' => 'required|array',
            'in_stock' => 'required|integer|min:0',
        ]);

        $genres = $validatedData['genres'];
        unset($validatedData['genres']);

        $book = new Book($validatedData);
        $book->save();
        $book->genres()->attach($genres);

        return redirect('/');
    }
}
