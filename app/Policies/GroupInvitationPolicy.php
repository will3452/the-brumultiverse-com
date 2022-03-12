<?php

namespace App\Policies;

use App\Models\GroupInvitation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupInvitationPolicy
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
        return $user->can('view list: group invitation');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupInvitation  $groupInvitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, GroupInvitation $groupInvitation)
    {
        return $user->can('view details: group invitation');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create group invitation');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupInvitation  $groupInvitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GroupInvitation $groupInvitation)
    {
        return $user->can('update group invitation');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupInvitation  $groupInvitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GroupInvitation $groupInvitation)
    {
        return $user->can('delete group invitation');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupInvitation  $groupInvitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GroupInvitation $groupInvitation)
    {
        return $user->can('restore group invitation');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupInvitation  $groupInvitation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GroupInvitation $groupInvitation)
    {
        return $user->can('force delete group invitation');
    }
}
