<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClosetController extends Controller
{
    public function tutorial()
    {
        return view('student.closet.tutorial');
    }

    public function myCloset () {
        return view('student.closet.me');
    }
}
