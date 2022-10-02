<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentBulletinController extends Controller
{
    public function index() {
        return view('student.bulletin');
    }
}
