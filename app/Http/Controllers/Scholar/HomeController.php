<?php

namespace App\Http\Controllers\Scholar;

use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return redirect(Nova::path());
        }

        if (! auth()->user()->isScholar()) {
            return redirect('/students');
        }

        if (auth()->user()->hasVerifiedEmail() && auth()->user()->hasAccountsApproved()) {
            return view('scholar.home');
        }

        if (! auth()->user()->hasVerifiedEmail()) {
            return redirect('verify-email-first');
        }


        if (! auth()->user()->hasAccountsApproved()) {
            return redirect(route('scholar.profile.show', ['user' => auth()->user()->id]));
        }

        return abort(404);
    }
}
