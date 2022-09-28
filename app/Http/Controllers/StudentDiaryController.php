<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;

class StudentDiaryController extends Controller
{
    public function index (Request $request) {
        if ($request->has('date')) {
            $records = Diary::where('created_at', 'LIKE', '%'.$request->date.'%')->whereUserId(auth()->id())->get();
        } else {
            $records = Diary::where('created_at', 'LIKE', '%'.now()->format('Y-m-d').'%')->whereUserId(auth()->id())->get();
        }
        return view('student.diary.index', ['records' => $records]);
    }


    public function store (Request $request) {
        $data = $request->validate([
            'content' => ['required'],
            'title' => ['required', 'max:250'],
        ]);

        $data['type'] = Diary::TYPE_TEXT;
        $data['user_id'] = auth()->id();

        Diary::create($data);
        toast('Entry has been saved!');
        return back();
    }
}
