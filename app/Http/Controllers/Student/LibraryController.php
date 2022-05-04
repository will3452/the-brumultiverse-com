<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class LibraryController extends Controller
{

    public function getBooks()
    {
        return Book::get()->groupBy(fn ($e) =>  $e->genre->name);
    }

    public function index()
    {
        return view('student.library.index', ['works' => $this->getBooks()]);
    }

    public function show(Book $work)
    {
        return view('student.library.show', compact('work'));
    }
}
