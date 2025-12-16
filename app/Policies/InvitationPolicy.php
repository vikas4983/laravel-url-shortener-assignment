<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Traits\RoleTrait;

class InvitationPolicy
{
    use RoleTrait;
    public function viewCreate(User $user): bool
    {

        return $user->hasAnyRole(['SuperAdmin', 'Admin']);
    }
    public function visibleRoles(User $user): array
    {
        if ($user->hasRole('SuperAdmin')) {
            return ['Admin'];
        }

        if ($user->hasRole('Admin')) {
            return ['Admin', 'Member'];
        }

        return [];
    }
    public function visibleCompanies(User $user)
    {
        if ($user->hasRole('SuperAdmin')) {
            return 'ALL';
        }

        if ($user->hasRole('Admin')) {
            return 'OWN';
        }

        return 'NONE';
    }

    public function create(User $user, int $companyId, int $roleId): bool
    {

        if ($user->hasRole('SuperAdmin')) {
            return $this->isAdminRole($roleId);
        }

        // Admin
        if ($user->hasRole('Admin')) {

            // Invite only from same company
            if ($user->company_id !== $companyId) {
                return false;
            }

            // admin invite admin and membar
            return  $this->isAdminOrMemberRole($roleId);
        }

        return false;
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
