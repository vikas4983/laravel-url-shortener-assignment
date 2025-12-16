<?php

use App\Models\Role;

if (!function_exists('roleIdByName')) {
    function roleIdByName(string $name): ?int
    {
        dd($name);
        return Role::where('name', $name)->value('id');
    }
}
