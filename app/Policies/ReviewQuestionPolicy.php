<?php

namespace App\Policies;

use App\Models\ReviewQuestion;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewQuestionPolicy
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
        return $user->can('view list: review question');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewQuestion  $reviewQuestion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ReviewQuestion $reviewQuestion)
    {
        return $user->can('view details: review question');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create review question');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewQuestion  $reviewQuestion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ReviewQuestion $reviewQuestion)
    {
        return $user->can('update review question');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewQuestion  $reviewQuestion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ReviewQuestion $reviewQuestion)
    {
        return $user->can('delete review question');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewQuestion  $reviewQuestion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ReviewQuestion $reviewQuestion)
    {
        return $user->can('restore review question');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ReviewQuestion  $reviewQuestion
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ReviewQuestion $reviewQuestion)
    {
        //
    }
}
