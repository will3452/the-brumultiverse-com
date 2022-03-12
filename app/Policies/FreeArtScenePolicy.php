<?php

namespace App\Policies;

use App\Models\FreeArtScene;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FreeArtScenePolicy
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
        return $user->can('view list: free art scene');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FreeArtScene  $freeArtScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FreeArtScene $freeArtScene)
    {
        return $user->can('view details: free art scene');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create free art scene');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FreeArtScene  $freeArtScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FreeArtScene $freeArtScene)
    {
        return $user->can('update free art scene');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FreeArtScene  $freeArtScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FreeArtScene $freeArtScene)
    {
        return $user->can('delete free art scene');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FreeArtScene  $freeArtScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FreeArtScene $freeArtScene)
    {
        return $user->can('restore free art scene');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FreeArtScene  $freeArtScene
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FreeArtScene $freeArtScene)
    {
        //
    }
}
