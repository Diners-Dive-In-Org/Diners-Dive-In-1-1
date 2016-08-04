<?php

namespace App\Repositories;

use App\User;

class BusinessRepository
{
    /**
     * Get all of the business for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->business()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}