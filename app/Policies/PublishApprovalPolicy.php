<?php

namespace App\Policies;

use App\Models\PublishApproval;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublishApprovalPolicy
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
        return $user->can('view list: publish approval');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishApproval  $publishApproval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PublishApproval $publishApproval)
    {
        return $user->can('view details: publish approval');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create publish approval');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishApproval  $publishApproval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PublishApproval $publishApproval)
    {
        return $user->can('update publish approval');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishApproval  $publishApproval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PublishApproval $publishApproval)
    {
        return $user->can('delete publish approval');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishApproval  $publishApproval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PublishApproval $publishApproval)
    {
        return $user->can('restore publish approval');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PublishApproval  $publishApproval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PublishApproval $publishApproval)
    {
        //
    }
}
