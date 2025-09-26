<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'helpdesk@gemarcph.com'],
            [
                'name' => 'Admin',
                'email' => 'helpdesk@gemarcph.com',
                'password' => Hash::make('Ivandineros23!'),
                'role' => 'admin',
                'is_admin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        echo "Admin user created/updated!\n";
    }
}
