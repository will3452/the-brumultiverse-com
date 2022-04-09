<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function setup()
    {
        return view('student.avatar');
    }

    public function create()
    {
        return view('avatar_create');
    }
}
