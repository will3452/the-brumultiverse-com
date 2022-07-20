<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function intro()
    {
        return view('student.library.intro');
    }

    public function getBooks()
    {
        return Book::published()->whereHas('bookContent')->get()->groupBy(fn ($e) =>  $e->genre->name);
    }

    public function index(Request $request)
    {
        $works = [];
        if ($request->has('search') && $request->search != '') {
            $works = Book::published()->whereHas('bookContent')->where('title', 'LIKE', '%'.$request->search.'%')->get();
        } else {
            $works = $this->getBooks();
        }
        return view('student.library.index', ['works' => $works]);
    }

    public function show(Book $work)
    {
        return view('student.library.show', compact('work'));
    }
}
