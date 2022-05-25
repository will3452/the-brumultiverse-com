<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ArtScene;
use Illuminate\Http\Request;

class MuseumController extends Controller
{
    public function getArts()
    {
        return ArtScene::get()->groupBy(fn ($e) =>  $e->genre->name);
    }

    public function index(Request $request)
    {
        $works = [];
        if ($request->has('search')) {
            $works = ArtScene::where('title', 'LIKE', '%'.$request->search.'%')->get();
        } else {
            $works = $this->getArts();
        }

        return view('student.museum.index', ['works' => $works]);
    }

    public function show(ArtScene $work)
    {
        return view('student.museum.show', compact('work'));
    }

    public function intro()
    {
        return view('student.museum.intro');
    }
}
