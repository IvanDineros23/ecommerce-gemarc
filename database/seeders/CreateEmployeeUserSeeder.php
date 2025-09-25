<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateEmployeeUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'kitona@gemarcph.com'],
            [
                'name' => 'Kitona Employee',
                'email' => 'kitona@gemarcph.com',
                'password' => Hash::make('salesdepartment'),
                'role' => 'employee',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        echo "Employee user created/updated!\n";
    }
}
