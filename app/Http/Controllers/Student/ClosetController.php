<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AvatarAsset;
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

    public function mirror () {
        return view('student.closet.mirror');
    }

    public function drawer () {
        return view('student.closet.drawer');
    }

    public function saveAvatar (Request $request) {
        if ( $request->has('hair')) {
            $as = AvatarAsset::find($request->hair);
            auth()->user()->avatar()->update(['hair' => $as->path]);
        }

        if ( $request->has('dress')) {
            $as = AvatarAsset::find($request->dress);
            auth()->user()->avatar()->update(['dress' => $as->path]);
        }
        toast('Avatar saved!');
        return redirect()->to(route('student.closet.me'));
    }
}
