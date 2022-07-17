<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\College;
use App\Models\Interest;
use App\Helpers\FormHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRegisterRequest;

class RegisterController extends Controller
{
    public function showRegister()
    {
        $colleges = College::get();
        if ( auth()->check() ) {
            return redirect()->to(route('student.map'));
        }
        return view('student.register', compact('colleges'));
    }

    public function register(StudentRegisterRequest $request)
    {
        $data = $request->validated();

        $interestField = [
            'course_id' => $data['course'],
            'college_id' => $data['college'],
            'club_id' => $data['club'],
        ];

        $userFields = FormHelper::removeDataWithKeys(['course', 'college', 'club'], $data);

        $userFields['password'] = bcrypt($userFields['password']);

        //this will create a fields
        $user = User::create($userFields);

        //create interest of the newly created user
        $interestField['user_id'] = $user->id;
        Interest::create($interestField);

        //log the user in
        auth()->login($user);

        return redirect(route('student.after.register'));
    }

    public function registerAfter(Request $request)
    {
        if ($request->has('redirect')) {
            session('redirect', $request->redirect);
        }
        return view('student.after-register');
    }

    public function saveAccount(Request $r)
    {
        if (! auth()->user()->hasSubscription()) {
            auth()->user()->subscriptions()->create(); // for free students.
        }

        if ($r->account === User::ACCOUNT_PREMIUM) {
            auth()->user()->changeSubscription(User::ACCOUNT_PREMIUM);
        } else {
            auth()->user()->changeSubscription(User::ACCOUNT_FREE);
        }

        if (session()->has('redirect')) {
            return redirect()->to(session()->get('redirect'));
        }

        return redirect(route('student.welcome.dorm'));
    }

    public function welcomeToDorm()
    {
        if (auth()->user()->tutorial_finished == 1 && auth()->user()->avatar_updated == 1) {
            return redirect(route('student.closet.me'));
        }
        return view('student.welcome-dorm');
    }

    public function welcomeToCloset()
    {
        auth()->user()->finishTutorial(); // tutorial once only
        return view('student.welcome-closet');
    }
}
