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
        if (! $user->hasBalance()) {
            $user->balance()->create(['hall_pass' => 0, 'purple_crystal' => 0, 'white_crystal' => 0, 'silver_ticket' => 0]);
        }
    }
}
