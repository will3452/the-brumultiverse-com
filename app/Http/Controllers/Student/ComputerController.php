<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function dashboard ()
    {
        return view('student.computer.dashboard');
    }

    public function setting ()
    {
        return view('student.computer.settings');
    }

    public function writeWithUs ()
    {
        return view('student.computer.write');
    }

    public function homework ()
    {
        return view('student.computer.homeworks');
    }
}
