<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    use RedirectsUsers;
    public function verify(Request $request, User $user)
    {
        if (!hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            throw new AuthorizationException;
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            if ($user->isScholar()) {
                return redirect(route('scholar.profile.show', ['user' => $user->id]));
            }
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath());
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        if ($user->isScholar()) {
            return redirect(route('scholar.profile.show', ['user' => $user->id]));
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
        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath());
        }

        $user->sendEmailVerificationNotification();

        return 'Verification link has been sent to your email!';
    }
}
