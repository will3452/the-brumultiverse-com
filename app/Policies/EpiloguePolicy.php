<?php

namespace App\Policies;

use App\Models\Epilogue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EpiloguePolicy
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
        return $user->can('view list: epilogue');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Epilogue  $epilogue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Epilogue $epilogue)
    {
        return $user->can('view details: epilogue');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create epilogue');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Epilogue  $epilogue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Epilogue $epilogue)
    {
        return $user->can('update epilogue');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Epilogue  $epilogue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Epilogue $epilogue)
    {
        return $user->can('delete epilogue');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Epilogue  $epilogue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Epilogue $epilogue)
    {
        return $user->can('restore epilogue');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Epilogue  $epilogue
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Epilogue $epilogue)
    {
        //
    }
}
