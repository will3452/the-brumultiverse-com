<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    use RedirectsUsers;
    public function verify(Request $request, User $user)
    {
        if ($user->hasVerifiedEmail()) {
            if ($user->isScholar()) {
                return redirect(route('scholar.profile.show', ['user' => $user->id]));
            }
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath());
        }

        return $user;

        $updateEmail = $user->update(['email_verified_at' => now()]);

        if ($updateEmail) {
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
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return 'Verification link has been sent to your email!';
    }
}
