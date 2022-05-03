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

    public function index()
    {
        return view('student.museum.index', ['works' => $this->getArts()]);
    }
}
