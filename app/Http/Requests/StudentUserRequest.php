<?php

namespace App\Http\Requests;

use App\Rules\ValidAge;
use Illuminate\Foundation\Http\FormRequest;

class StudentUserRequest extends FormRequest
{
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
            'gender' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'birth_date' => ['required',new ValidAge],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
            'college' => 'required',
            'course' => 'required',
            'club' => 'required',
            'picture' => ['required', 'image', 'max:5000']
        ];
    }
}
