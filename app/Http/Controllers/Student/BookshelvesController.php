<?php

namespace App\Http\Controllers\Student;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\StudentCollection;
use App\Models\BookContentChapter;
use App\Models\ReadingLog;

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
        try {
            if (! auth()->user()->readingLogs()->whereBookId($work->id)->exists()) {

                $firstChapter = $work->bookContentChapters()->first();

                if(is_null($firstChapter)) {
                    return 'no chapter found!';
                }

                if (! auth()->user()->canProceedToRead($work, $firstChapter)) {
                    toast("You don't have enough balance to read this book!");
                    return back();
                }
                //create first log
                ReadingLog::create([
                    'user_id' => auth()->id(),
                    'book_id' => $work->id,
                    'chapter_id' => $firstChapter->id,
                    'page_number' => $firstChapter->start_page
                ]);
            }
            return view('student.bookshelves.read', compact('work'));
        } catch (\Exception $err) {
            toast('Something went wrong, please contact the author or administrator to resolve the issue.');
        }
    }

    public function stopOver (Request $request, Book $book) {
        $page = $request->page;
        $chapter = BookContentChapter::findOrFail($request->chapter);
        return view('student.bookshelves.stop-over', compact('book', 'page', 'chapter'));
    }
}
