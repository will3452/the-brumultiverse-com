<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('scholar.book.index');
    }

    public function create()
    {
        return view('scholar.book.create');
    }
}
