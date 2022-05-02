<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DormController extends Controller
{
    public function tutorial()
    {
        return view('student.dorm.tutorial');
    }
}
