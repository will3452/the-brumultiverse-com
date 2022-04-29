<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function viewMap()
    {
        return 'hell';
        return view('student.map');
    }
}
