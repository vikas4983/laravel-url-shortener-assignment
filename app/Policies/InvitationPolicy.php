<?php

namespace App\Policies;

use App\Models\Invitation;
use App\Models\Role;
use App\Models\User;
use App\Traits\RoleTrait;

class InvitationPolicy
{
    
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
        if ($user->hasRole('Member')) {
            return ['Member'];
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
        if ($user->hasRole('Member')) {
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
            return $this->isAdminOrMemberRole($roleId);
        }

        return false;
    }
    protected function isAdminRole(int $roleId): bool
    {
        return Role::where('id', $roleId)->where('name', 'Admin')->exists();
    }
    protected function isAdminOrMemberRole(int $roleId): bool
    {
        return Role::where('id', $roleId)
            ->whereIn('name', ['Admin', 'Member'])
            ->exists();
    }

    public function view(User $user)
    {
        if ($user->hasRole('SuperAdmin')) {
            return Invitation::paginate(5);
        }
        if ($user->hasRole('Admin')) {
            return Invitation::where('invited_by', $user->id)->paginate(5);
        }
        if ($user->hasRole('Member')) {
            return Invitation::where('invited_by', $user->id)->paginate(5);
        }
    }
}
