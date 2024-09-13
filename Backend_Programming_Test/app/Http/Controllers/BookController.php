<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');

        // Ambil data buku dengan filter pencarian dan pagination
        $booksQuery = Book::with('category', 'author')
            ->where('title', 'like', "%{$search}%");

        // Hitung total buku untuk pagination
        $books = $booksQuery->paginate($perPage);

        // Perhitungan average_rating dan vote_count
        $books->getCollection()->transform(function ($book) {
            $ratings = $book->ratings;
            $book->average_rating = $ratings->avg('rating');
            $book->vote_count = $ratings->where('rating', '>', 5)->count();
            return $book;
        });

        return view('books.index', [
            'books' => $books,
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }

    public function topAuthors()
    {
        $topAuthors = DB::table('authors')
            ->join('books', 'authors.id', '=', 'books.author_id')
            ->join('ratings', 'books.id', '=', 'ratings.book_id')
            ->select('authors.name', DB::raw('COUNT(ratings.id) as vote_count'))
            ->where('ratings.rating', '>', 5)
            ->groupBy('authors.id')
            ->orderBy('vote_count', 'desc')
            ->limit(10)
            ->get();

        return view('authors.top', compact('topAuthors'));
    }

    
    public function addRating()
    {
        $authors = Author::all();
        
        $booksQuery = Book::query();

        if (request('author_id')) {
            $booksQuery = $booksQuery->where('author_id', request('author_id'));
        }

        if (request('title')) {
            $booksQuery = $booksQuery->where('id', request('title'));
        }

        if (request('rating')) {
            $booksQuery = $booksQuery->where('average_rating', request('rating'));
        }

        $books = $booksQuery->get();

        // Get book titles based on the selected author
        $titles = Book::when(request('author_id'), function ($query) {
            return $query->where('author_id', request('author_id'));
        })->pluck('title', 'id');

        return view('ratings.create', [
            'authors' => $authors,
            'books' => $books,
            'titles' => $titles
        ]);
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Rating added successfully!');
    }
}


