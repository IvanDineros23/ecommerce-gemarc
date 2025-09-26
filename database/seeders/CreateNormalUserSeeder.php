<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateNormalUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'dom@gemarcph.com'],
            [
                'name' => 'Dom User',
                'email' => 'dom@gemarcph.com',
                'password' => Hash::make('salesdepartment'),
                'role' => 'user',
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        echo "Normal user created/updated!\n";
    }
}
