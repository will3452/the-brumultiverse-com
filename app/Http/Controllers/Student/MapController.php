<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function viewMap()
    {
        if (auth()->check() && ! auth()->user()->hasBalance()) {
            auth()->user()->balance()->create(['hall_pass' => 0, 'purple_crystal' => 0, 'white_crystal' => 0, 'silver_ticket' => 0]);
        }
        return view('student.map');
    }
}
