<?php

namespace App\Http\Controllers\Student;

use App\Models\College;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegister()
    {
        $colleges = College::get();
        return view('student.register', compact('colleges'));
    }
}
