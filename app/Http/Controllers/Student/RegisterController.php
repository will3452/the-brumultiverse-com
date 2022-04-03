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

    public function registerAfter()
    {
        return view('student.after-register');
    }
}
