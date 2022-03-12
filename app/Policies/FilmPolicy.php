<?php

namespace App\Policies;

use App\Models\Film;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmPolicy
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
        return $user->can('view list: film');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Film $film)
    {
        return $user->can('view details: film');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create film');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Film $film)
    {
        return $user->can('update film');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Film $film)
    {
        return $user->can('delete film');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Film $film)
    {
        return $user->can('restore film');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Film  $film
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Film $film)
    {
        //
    }
}
