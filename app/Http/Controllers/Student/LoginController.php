<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['email', 'exists:users,email', 'required'],
            'password' => ['required']
        ]);

        if (auth()->attempt($data, true)) {
            return redirect($this->redirectAfterLogin());
        }

        return back()->withError('Incorrect Email or Password!');
    }

    public function createBalance() {
        return Balance::create(['user_id' => auth()->id()]);
    }

    public function redirectAfterLogin()
    {

        if (! auth()->user()->hasBalance()) {
            $this->createBalance();
        }

        if (! auth()->user()->isFinishedTutorial()) {
            return route('student.welcome.dorm');
        }

        if (! auth()->user()->hasAvatarSet()) {
            return route('student.welcome.closet');
        }
        return route('student.map');
    }
}
