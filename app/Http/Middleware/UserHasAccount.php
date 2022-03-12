<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHasAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        dd(Auth::user());
        // if ($request->user() && ! $request->user()->accounts()->count()) {
        //     return redirect(Nova::path() . "/resources/accounts/");
        // }
        return $next($request);
    }
}
