<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN USER
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@sembark.com',
            'company_id' => 1,
            'password' => Hash::make('adminadmin'),
        ]);

        $adminRole = Role::where('name', 'Admin')->first();
        $adminUser->roles()->attach($adminRole->id);

        // MEMBER USER
        $memberUser = User::create([
            'name' => 'Member',
            'email' => 'member@sembark.com',
            'company_id' => 2,
            'password' => Hash::make('membermember'),
        ]);

        $memberRole = Role::where('name', 'Member')->first();
        $memberUser->roles()->attach($memberRole->id);
    }
}
