<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Epilogue;
use App\Models\Prologue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrologueEpilogueController extends Controller
{
    public function showPrologue(Prologue $prologue)
    {
        $book = $prologue->model;
        return view('scholar.prologue.show', compact('book', 'prologue'));
    }

    public function updatePrologue(Request $request, Prologue $prologue)
    {
        $data = $request->validate(['body' => 'required']);

        $prologue->update($data);
        return back()->withSuccess('updated!');
    }

    public function showEpilogue(Epilogue $epilogue)
    {
        $book = $epilogue->model;
        return view('scholar.epilogue.show', compact('book', 'epilogue'));
    }

    public function updateEpilogue(Request $request, Epilogue $epilogue)
    {
        $data = $request->validate(['body' => 'required']);

        $epilogue->update($data);
        return back()->withSuccess('updated!');
    }
}
