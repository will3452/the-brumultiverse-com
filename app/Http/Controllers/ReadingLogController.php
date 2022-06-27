<?php

namespace App\Http\Controllers;

use App\Models\BookContentChapter;
use Illuminate\Http\Request;

class ReadingLogController extends Controller
{
    public function saveLog (Request $request) {
        return auth()->user()->readingLogs()->create([
            'book_id' => $request->book_id,
            'page_number' => $request->page_number,
            'chapter_id' => $request->chapter_id,
        ]);
    }

    public function hasLog (Request $request) {
        if (auth()->user()->readingLogs()->wherePageNumber($request->page_number)->exists()) {
            return ['existing' => true];
        }
        return ['existing' => false];
    }
}
