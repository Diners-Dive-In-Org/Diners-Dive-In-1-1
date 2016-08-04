<?php

namespace App\Policies;

use App\User;
use App\Business;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Business  $business
     * @return bool
     */
    public function destroy(User $user, Business $business)
    {
        return $user->id === $business->user_id;
    }
}
