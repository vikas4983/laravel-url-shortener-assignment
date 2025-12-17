<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = ['Company-1', 'Company-2', 'Company-3', 'Company-4', 'Company-5'];
        foreach ($companies as $company) {
            Company::create(['name' => $company]);
        }
    }
}
