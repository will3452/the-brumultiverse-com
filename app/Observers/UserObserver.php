<?php

namespace App\Observers;

use App\Models\Avatar;
use App\Models\Role;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        $role = Role::loadRole($user->role ?? User::ROLE_NORMAL);
        $user->assignRole($role);

        Avatar::create(['user_id' => $user->id]);
    }
}
