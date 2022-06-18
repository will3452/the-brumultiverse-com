<?php

namespace App\Http\Controllers\Student;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\StudentCollection;

class BookshelvesController extends Controller
{
    use StudentCollection;

    public function getModel ()
    {
        return Book::class;
    }

    public function index (Request $request) {
        $works = [];
        if ($request->has('search') && $request->search != '') {
            $works = Book::whereIn('id', $this->myWorkCollection())->where('title', 'LIKE', '%'.$request->search.'%')->get();
        } else {
            $works = $this->getWorks();
        }

        return view('student.bookshelves.index', compact('works'));
    }

    public function show(Book $work)
    {
        return view('student.bookshelves.show', compact('work'));
    }

    public function read(Book $work)
    {
        return view('student.bookshelves.read', compact('work'));
    }
}
