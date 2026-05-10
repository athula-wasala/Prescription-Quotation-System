<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view users.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('manage users');
    }

    /**
     * Determine whether the user can update users.
     */
    public function update(User $user): bool
    {
        return $user->can('manage users');
    }

    /**
     * Determine whether the user can delete users.
     */
    public function delete(User $user): bool
    {
        return $user->can('manage users');
    }
}