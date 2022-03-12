<?php

namespace App\Http\Controllers;

use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Http\Controllers\LoginController as ControllersLoginController;

class LoginController extends ControllersLoginController
{
    public function redirectPath()
    {
        if (Auth::check()) {
            if (! auth()->user()->accounts()->count()) {
                return Nova::path() . '/resources/accounts';
            }
            return Nova::path();
        }
    }
}
