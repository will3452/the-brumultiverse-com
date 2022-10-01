<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ReadingLog;
use Illuminate\Http\Request;
use App\Models\BookContentChapter;

class ReadingLogController extends Controller
{
    public function saveLog (Request $request) {
        try {
            $creation = auth()->user()->readingLogs()->create([
                'book_id' => $request->book_id,
                'page_number' => $request->page_number,
                'chapter_id' => $request->chapter_id,
            ]);
            if ($creation) {
                return redirect()->to(route('student.bs.read',['work' => $request->book_id]) . '#book/' . $request->page_number);
            }
        }catch(Exception $e) {
            return $e;
            toast('Something went wrong');
            return back();
        }
    }

    public function hasLog (Request $request) {
        if (ReadingLog::wherePageNumber($request->page_number)->whereBookId($request->book_id)->exists()) {
            return ['request' => $request->all(), 'existing' => true, 'auth' => auth()->id(), 'q' => ReadingLog::wherePageNumber($request->page_number)->whereBookId($request->book_id)->exists()];
        }

        error_log('page_number >> ' . $request->page_number);
        return ['request' => $request->all(), 'existing' => false, 'auth' => auth()->id(), 'q' => ReadingLog::wherePageNumber($request->page_number)->whereBookId($request->book_id)->exists()];
    }
}
