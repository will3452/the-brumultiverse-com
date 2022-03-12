<?php

namespace App\Policies;

use App\Models\Series;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeriesPolicy
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
        return $user->can('view list: series');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Series $series)
    {
        return $user->can('view details: series');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create series');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Series $series)
    {
        return $user->can('update series');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Series $series)
    {
        return $user->can('delete series');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Series $series)
    {
        return $user->can('restore series');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Series $series)
    {
        //
    }
}
