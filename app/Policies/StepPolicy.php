<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Step;

class StepPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    
    public function update(User $user, Step $step)
    {
        return $user->id === $step->snippet->user->id;
    }

    public function destroy(User $user, Step $step)
    {
        return $user->id === $step->snippet->user_id;
    }
}
