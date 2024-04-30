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

    public function listBooksByGenre($genreName)
    {
        $genre = Genre::where('name', $genreName)->first();
        $books = $genre->books;
        // dd($books);
        return view('listBooksByGenre', ['books' => $books, 'genreName' => $genreName]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $books = Book::where('title', 'like', "%{$search}%")
            ->orWhere('authors', 'like', "%{$search}%")
            ->get();
        return view('search_results', ['books' => $books]);
    }
    public function show($bookId)
    {
        $book = Book::find($bookId);
        $user = Auth::user();
        $hasOngoingRental = false;

        if ($user) {
            $hasOngoingRental = $user->hasOngoingRental($book->id);
        }

        return view('book_details', ['book' => $book, 'user' => $user, 'hasOngoingRental' => $hasOngoingRental]);
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
            'cover_image' => 'url',
        ]);

        $genres = $validatedData['genres'];
        unset($validatedData['genres']);

        $book = new Book($validatedData);
        $book->save();
        $book->genres()->attach($genres);

        return redirect('/');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    // signin

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }




    // borrow

    public function borrow(Request $request)
    {
        $book = Book::find($request->book_id);
        $user = Auth::user();


        if (!$user->hasOngoingRental($book->id)) {
            Borrow::create([
                'book_id' => $book->id,
                'reader_id' => $user->id,
                'status' => 'PENDING',
                'request_processed_at' => null,
                'request_managed_by' => null,
            ]);
        }else{
            return redirect()->back()->with('error', 'You already have an ongoing rental for this book.');
        }

        return redirect()->route('book_details', ['bookId' => $book->id]);
    }


    // Edit book
    public function edit($bookId)
    {
        $book = Book::find($bookId);
        $genres = Genre::all();
        return view('book_edit', ['book' => $book, 'genres' => $genres]);
    }

    public function update(Request $request, $bookId)
    {
        $book = Book::find($bookId);
        $book->update($request->all());
        return redirect()->route('book_details', ['bookId' => $book->id]);
    }

    // delete
    public function destroy($bookId)
    {
        $book = Book::find($bookId);

        if ($book) {
            // delete in associated tables
            $book->genres()->detach();
            $book->borrows()->delete();

            $book->delete();

            return redirect('/')->with('success', 'Book deleted successfully');
        }

        return redirect('/')->with('error', 'Book not found');
    }


    // List genres

    public function genres()
    {
        $genres = Genre::all(); // Fetch all genres
        return view('genres_index', ['genres' => $genres]);
    }

    public function storeGenre(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'style' => 'required|in:primary,secondary,success,danger,warning,info,light,dark',
        ]);

        $genre = new Genre;
        $genre->name = $request->name;
        $genre->style = $request->style;
        $genre->save();

        return redirect()->route('genres_index')->with('success', 'Genre added successfully');
    }

    public function createGenre()
    {
        return view('genreCreate');
    }

    public function destroyGenre($genreId)
    {
        $genre = Genre::find($genreId);
        if ($genre) {
            $genre->delete();
            return redirect()->route('genres_index')->with('success', 'Genre deleted successfully');
        }
        return redirect()->route('genres_index')->with('error', 'Genre not found');
    }
    public function editGenre($genreId)
    {
        $genre = Genre::find($genreId);
        return view('genres_edit', ['genre' => $genre]);
    }

    public function updateGenre(Request $request, $genreId)
    {
        $genre = Genre::find($genreId);
        $genre->name = $request->input('name');
        $genre->save();

        return redirect()->route('genres_index');
    }

    public function listRentals()
    {
        $pendingRentals = Borrow::where('status', 'PENDING')->get();
        $acceptedRentals = Borrow::where('status', 'ACCEPTED')->where('deadline', '>', now())->get();
        $lateRentals = Borrow::where('status', 'ACCEPTED')->where('deadline', '<', now())->get();
        $rejectedRentals = Borrow::where('status', 'REJECTED')->get();
        $returnedRentals = Borrow::where('status', 'RETURNED')->get();

        return view('rentalList', compact('pendingRentals', 'acceptedRentals', 'lateRentals', 'rejectedRentals', 'returnedRentals'));
    }

    public function showRentalDetails($id)
    {
        $rental = Borrow::findOrFail($id);

        return view('rentalDetails', compact('rental'));
    }

    public function updateRental(Request $request, $id)
    {
        $rental = Borrow::findOrFail($id);

        $request->validate([
            'status' => 'required|in:PENDING,ACCEPTED,REJECTED,RETURNED',
            'deadline' => 'required|date',
        ]);

        $rental->status = $request->status;
        $rental->deadline = $request->deadline;
        $rental->save();

        return redirect()->route('rentals.show', $rental->id);
    }
}
