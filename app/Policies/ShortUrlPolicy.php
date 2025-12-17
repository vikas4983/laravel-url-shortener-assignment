<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\ShortUrl;
use App\Models\User;

class ShortUrlPolicy
{
    /**
     * Create a new policy instance.
     */
    public function visibleCompanies(User $user)
    {

        if ($user->hasRole('Admin')) {
            return 'OWN';
        }
        if ($user->hasRole('Member')) {
            return 'OWN';
        }

        return 'NONE';
    }
    public function view(User $user)
    {

        if ($user->hasRole('SuperAdmin')) {
            return ShortUrl::paginate(5);
        }
        if ($user->hasRole('Admin') || $user->hasRole('Member')) {
            return ShortUrl::where('user_id', $user->id)->paginate(5);
        }
       
    }
    protected function isAdminRole(int $roleId): bool
    {
        return Role::where('id', $roleId)
            ->where('name', 'Admin')
            ->exists();
    }
    protected function isAdminOrMemberRole(int $roleId): bool
    {
        return Role::where('id', $roleId)
            ->whereIn('name', ['Admin', 'Member'])
            ->exists();
    }
}
