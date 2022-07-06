<?php

namespace App\Http\Controllers\Student;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\StudentCollection;
use App\Models\BookContentChapter;

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
        return 'under maintenance...'; // TODO, we must check if the can read the first chapter of the book
        return view('student.bookshelves.read', compact('work'));
    }

    public function stopOver (Request $request, Book $book) {
        $page = $request->page;
        $chapter = BookContentChapter::findOrFail($request->chapter);
        return view('student.bookshelves.stop-over', compact('book', 'page', 'chapter'));
    }
}
