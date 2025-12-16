<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Company;
use App\Models\User;

class CompanyPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    /**
     * Determine whether the user can view the model.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('SuperAdmin');
    }

    public function view(User $user): bool
    {
        return $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasRole('SuperAdmin');
    }
    public function store(User $user): bool
    {
        return $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasRole('SuperAdmin');
    }


    /**
     * Determine whether the user can restore the model.
     */
}
