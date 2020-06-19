<?php

namespace App\Policies;

use App\Snippet;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SnippetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Snippet  $snippet
     * @return mixed
     */
    public function show(?User $user, Snippet $snippet)
    {
        if($snippet->isPublic()){
            return true;
        }
        return optional($user)->id === $snippet->user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Snippet  $snippet
     * @return mixed
     */
    public function update(User $user, Snippet $snippet)
    {
        return $user->id === $snippet->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Snippet  $snippet
     * @return mixed
     */
    public function storeStep(User $user, Snippet $snippet)
    {
        return $user->id === $snippet->user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Snippet  $snippet
     * @return mixed
     */
    public function restore(User $user, Snippet $snippet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Snippet  $snippet
     * @return mixed
     */
    public function forceDelete(User $user, Snippet $snippet)
    {
        //
    }
}
