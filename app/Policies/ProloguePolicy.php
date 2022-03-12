<?php

namespace App\Policies;

use App\Models\Prologue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProloguePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view list: prologue');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Prologue  $prologue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Prologue $prologue)
    {
        return $user->can('view details: prologue');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create prologue');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Prologue  $prologue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Prologue $prologue)
    {
        return $user->can('update prologue');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Prologue  $prologue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Prologue $prologue)
    {
        return $user->can('delete prologue');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Prologue  $prologue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Prologue $prologue)
    {
        return $user->can('view list: prologue');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Prologue  $prologue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Prologue $prologue)
    {
        //
    }
}
