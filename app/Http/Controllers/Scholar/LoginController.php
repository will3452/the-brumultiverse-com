<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('scholar.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($data)) {

            if (is_null(auth()->user()->last_login_at)) {
                auth()->user()->updateLastLogin(); // this will update last_login_of_the_user
            }

            return redirect(
                route('scholar.home')
                );
        }

        return back()->withError('Invalid Credentials');
    }

    public function logout()
    {
        auth()->user()->updateLastLogin(); // this will update last_login_of_the_user
        auth()->logout();
        return redirect('/');
    }
}
