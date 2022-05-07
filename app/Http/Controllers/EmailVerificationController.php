<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Auth\Access\AuthorizationException;

class EmailVerificationController extends Controller
{
    use RedirectsUsers;
    public function verify(Request $request, User $user)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user()->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            if ($request->user()->isScholar()) {
                return redirect(route('scholar.profile.show', ['user' => $request->user()->id]));
            }
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        if ($request->user()->isScholar()) {
            return redirect(route('scholar.profile.show', ['user' => $request->user()->id]));
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect($this->redirectPath())->with('verified', true);
    }


    protected function verified(Request $request)
    {
        //
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return 'Verification link has been sent to your email!';
    }
}
