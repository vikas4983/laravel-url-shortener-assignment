<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name'       => 'SuperAdmin',
            'email'      => 'superadmin@sembark.com',
            'company_id' => null,
            'password'   => Hash::make('superadmin'),
        ]);
        $role = Role::where('name', 'SuperAdmin')->first();
        // Attach role using Eloquent
        $superAdmin->roles()->attach($role->id);
    }
}
