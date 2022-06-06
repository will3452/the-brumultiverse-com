<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Book;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookContent;

class BookContentController extends Controller
{
    public function create (Request $request, Book $book)
    {
        return view('scholar.book.upload-content', compact('book'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'book_id' => 'required',
            'pdf' => 'required',
            'number_of_pages' => 'required',
        ]);

        $data['pdf'] = FileHelper::filepondSave($data['pdf']);
        BookContent::create($data);
        return redirect()->to(route('scholar.book.show', ['book' => $data['book_id']]))->withSuccess('Content Uploaded');
    }
}
