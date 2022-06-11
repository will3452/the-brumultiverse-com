<?php

namespace App\Http\Controllers\Student;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookshelvesController extends Controller
{
    public function getBooks()
    {
        return Book::whereIn('id', $this->myBookCollectionsId())->get()->groupBy(fn ($e) =>  $e->genre->name);
    }

    public function myBookCollectionsId(): array
    {
        return auth()->user()->studentCollections()->whereModelType(Book::class)->pluck('model_id')->toArray();
    }

    public function index (Request $request) {
        $works = [];
        if ($request->has('search') && $request->search != '') {
            $works = Book::whereIn('id', $this->myBookCollectionsId())->where('title', 'LIKE', '%'.$request->search.'%')->get();
        } else {
            $works = $this->getBooks();
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
