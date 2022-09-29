<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentAdminController extends Controller
{
    public function index () {
        return view('student.admin.lobby');
    }
}
