<?php

namespace App\Rules;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class ConversationMustNotAvailable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $username = User::findOrFail($value)->user_name;
        $name1 = Chat::createName($username, auth()->user()->user_name);
        $name2 = Chat::createName(auth()->user()->user_name, $username);
        return Chat::whereIn('name', [$name1, $name2])->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The conversation is already available.';
    }
}
