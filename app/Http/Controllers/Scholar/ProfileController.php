<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('scholar.profile.show', compact('user'));
    }
}
