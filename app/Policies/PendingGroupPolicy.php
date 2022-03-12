<?php

namespace App\Policies;

use App\Models\PendingGroup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PendingGroupPolicy
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
        return $user->can('view list: pending group');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PendingGroup  $pendingGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PendingGroup $pendingGroup)
    {
        return $user->can('view details: pending group');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PendingGroup  $pendingGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PendingGroup $pendingGroup)
    {
        return $user->can('update pending group');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PendingGroup  $pendingGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PendingGroup $pendingGroup)
    {
        return $user->can('delete pending group');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PendingGroup  $pendingGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PendingGroup $pendingGroup)
    {
        return $user->can('restore pending group');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PendingGroup  $pendingGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PendingGroup $pendingGroup)
    {
        return $user->can('force delete pending group');
    }
}
