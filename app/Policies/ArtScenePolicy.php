<?php

namespace App\Policies;

use App\Models\ArtScene;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtScenePolicy
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
        return $user->can('view list: art scene');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArtScene  $artScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ArtScene $artScene)
    {
        return $user->can('view details: art scene');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create art scene');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArtScene  $artScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ArtScene $artScene)
    {
        return $user->can('update art scene');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArtScene  $artScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ArtScene $artScene)
    {
        return $user->can('delete art scene');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArtScene  $artScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ArtScene $artScene)
    {
        return $user->can('restore art scene');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ArtScene  $artScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ArtScene $artScene)
    {
        //
    }
}
