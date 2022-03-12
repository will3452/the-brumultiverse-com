<?php

namespace App\Policies;

use App\Models\GroupType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupTypePolicy
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
        return $user->can('view group type: list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupType  $groupType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, GroupType $groupType)
    {
        return $user->can('view group type: details');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create group type');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupType  $groupType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GroupType $groupType)
    {
        return $user->can('update group type');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupType  $groupType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GroupType $groupType)
    {
        return $user->can('delete group type');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupType  $groupType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GroupType $groupType)
    {
        return $user->can('restore group type');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupType  $groupType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GroupType $groupType)
    {
        return $user->can('force delete group type');
    }
}
