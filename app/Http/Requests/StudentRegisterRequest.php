<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRegisterRequest extends FormRequest
{

    public function getRedirectUrl()
    {
        if (strpos(url()->previous(), '?step=3')) {
            return url()->previous();
        }
        return url()->previous() . '?step=3'; // this will return to the form
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => ['required', 'unique:users,user_name'],
            'gender' => ['required'],
            'sex' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'birth_date' => 'required',
            'password' => ['required', 'confirmed'],
            'email' => ['required', 'unique:users,email'],
            'college' => ['required', 'exists:colleges,id'],
            'course' => ['required', 'exists:courses,id'],
            'club' => ['required', 'exists:clubs,id'],
        ];
    }
}
