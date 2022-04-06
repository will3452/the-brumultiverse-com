<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Category;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    public function customValidate($request)
    {
        return $request->validate([
            'title' => 'required',
            'number' => 'required',
            'content' => 'required',
            'type' => '',
            'description' => '',
            'age_restriction' => '',
            'notes' => 'required',
            'cost' => '',
        ]);
    }
    public function show(Chapter $chapter)
    {
        $artScenes = auth()->user()->artScenes;
        return view('scholar.book.chapter.show', compact('chapter', 'artScenes'));
    }

    public function create(Book $book)
    {
        $fileType = $book->category->file_type;
        return view('scholar.book.chapter.create', compact('book', 'fileType'));
    }

    public function store(Request $request, Book $book)
    {
        $data = $this->customValidate($request);

        if ($book->category->file_type != Category::FILE_TYPE_TEXT) {
            $data['content'] = FileHelper::save($data['content']);
        }



        if (! $request->has('cost')) {
            $data['cost'] = 0;
        }

        //set the cost_type
        $data['cost_type'] = $request->cost_type ?? Chapter::DEFAULT_COST_TYPE;
        $data['type'] = $request->type ?? Chapter::TYPE_PLATINUM;
        $data['cost'] = $request->cost ?? 0;

        $book->chapters()->create($data);

        return redirect(route('scholar.book.chapters', ['book' => $book->id]))->withSuccess('Chapter Created!');
    }

    public function update(Request $request, Chapter $chapter)
    {
        $data = $this->customValidate($request);
        $chapter->update($data);
        return back()->withSuccess('Chapter updated!');
    }
}
