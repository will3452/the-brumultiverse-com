<?php

namespace App\Http\Controllers\Scholar;

use App\Helpers\CrystalHelper;
use App\Models\Book;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookContent;
use App\Models\BookContentChapter;

class BookContentController extends Controller
{
    public function create (Request $request, Book $book)
    {
        return view('scholar.book.upload-content', compact('book'));
    }

    public function setting (Request $request, Book $book)
    {
        $bookContentId = $book->bookContent->id;
        return view('scholar.book.content-setting', compact('book', 'bookContentId'));
    }

    public function preview (Request $request, Book $book) {
        return view('book-viewer', compact('book'));
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


    public function addChapter (Request $request) {
        $data = [];

        $book = Book::findOrFail($request->book_id);

        $bookContent = BookContent::findOrFail($request->book_content_id);

        $bookType = $book->type;

        if ( $request->type == "Regular") {
            $data['cost_type'] = CrystalHelper::HALL_PASS;
            $data['cost'] = 1;
        } else if ( $request->type == "Premium") {
            $data['cost_type'] = CrystalHelper::PURPLE_CRYSTAL;
            $data['cost'] = 1;
        } else if ( $request->type == "Special") {
            $data['cost_type'] = CrystalHelper::HALL_PASS;
            $data['cost'] = 2;
        }

        $data['book_id'] = $request->book_id;
        $data['age_restriction'] = $request->age_restriction;
        $data['book_content_id'] = $request->book_content_id;
        $data['start_page'] = $request->start_page;
        $data['end_page'] = $request->end_page;
        $data['type'] = $request->type;
        $data['authors_note'] = $request->authors_note;
        $data['description'] = $request->description;
        $data['sq'] = $request->sq;

        return BookContentChapter::create($data);
    }

    public function editChapter (Request $request, BookContentChapter $chapter) {
        $data = [];

        $book = Book::findOrFail($request->book_id);

        if ( $request->type == "Regular") {
            $data['cost_type'] = CrystalHelper::HALL_PASS;
            $data['cost'] = 1;
        } else if ( $request->type == "Premium") {
            $data['cost_type'] = CrystalHelper::PURPLE_CRYSTAL;
            $data['cost'] = 1;
        } else if ( $request->type == "Special") {
            $data['cost_type'] = CrystalHelper::PURPLE_CRYSTAL;
            $data['cost'] = 2;
        }

        $data['book_id'] = $request->book_id;
        $data['age_restriction'] = $request->age_restriction;
        $data['book_content_id'] = $request->book_content_id;
        $data['start_page'] = $request->start_page;
        $data['end_page'] = $request->end_page;
        $data['type'] = $request->type;
        $data['authors_note'] = $request->authors_note;
        $data['description'] = $request->description;
        $data['sq'] = $request->sq;

        return $chapter->update($data);
    }

    public function getChapter (Request $request, Book $book)
    {
        return $book->bookContentChapters()->orderBy('created_at')->get();
    }
}
