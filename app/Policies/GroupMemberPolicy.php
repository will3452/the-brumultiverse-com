<?php

namespace App\Policies;

use App\Models\GroupMember;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupMemberPolicy
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
        return $user->can('view list: group member');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, GroupMember $groupMember)
    {
        return $user->can('view details: group member');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create group member');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, GroupMember $groupMember)
    {
        return $user->can('update group member');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, GroupMember $groupMember)
    {
        return $user->can('delete group member');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, GroupMember $groupMember)
    {
        return $user->can('restore group member');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, GroupMember $groupMember)
    {
        return $user->can('view list: group member');
    }
}
