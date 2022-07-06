<?php

namespace App\Http\Controllers;

use App\Models\BookContentChapter;
use Exception;
use Illuminate\Http\Request;

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
            toast('Something went wrong');
            return back();
        }
    }

    public function hasLog (Request $request) {
        if (auth()->user()->readingLogs()->wherePageNumber($request->page_number)->exists()) {
            return ['existing' => true];
        }
        return ['existing' => false];
    }
}
