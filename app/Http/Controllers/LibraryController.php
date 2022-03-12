<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $books = [];
        if (request()->has('keyword')) {
            $keyword = request()->keyword;
            $books = Book::published()->where('title', "LIKE", "%$keyword%")->get();
        } else {
            $books = Book::published()->get();
        }

        return view('Initial.library_index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('Initial.library_show', compact('book'));
    }

    public function read(Book $book)
    {
        $chapters = $book->chapters()->simplePaginate(1);
        return view('Initial.library_read', compact('chapters'));
    }
}
