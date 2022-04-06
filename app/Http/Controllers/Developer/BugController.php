<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Bug;
use Illuminate\Http\Request;

class BugController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'uri' => 'required',
            'problem' => 'required',
            'replacement' => ''
        ]);
        Bug::create($data);
        return back()->withSuccess('bugs submitted!');
    }

    public function bugs()
    {
        $bugs = Bug::get();
        return view('dev.bugs', compact('bugs'));
    }

    public function markAsFixed(Request $request, Bug $bug)
    {
        $bug->update([
            'status' => Bug::STATUS_FIXED,
        ]);

        return back();
    }
}
