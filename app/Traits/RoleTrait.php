<?php

namespace App\Traits;

use App\Models\Role;

trait RoleTrait
{

    public function getRoleId(string $roleName)
    {
        return  Role::where('name', $roleName)->value('id');
    }
}
