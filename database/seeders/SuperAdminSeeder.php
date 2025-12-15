<?php

namespace Database\Seeders;

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
        // Create super admin user through SQL
        DB::insert(
            "
            INSERT INTO users(name,email,password,company_id,created_at,updated_at)
            VALUES(?,?,?,?,?,?)
        ",
            [
                'Vikas',
                'Vikas@gmail.com',
                Hash::make('Superadmin'),
                null,
                now(),
                now(),
            ]
        );
        // Get user id 
        $userId = DB::getPdo()->lastInsertId();
        // Get super admin primary key
        $roleId = DB::table('roles')
            ->where('name', 'SuperAdmin')
            ->value('id');
            // Add role
        DB::insert("
            INSERT INTO role_user (user_id, role_id)
            VALUES (?, ?)
        ", [
            $userId,
            $roleId
        ]);
    }
}
