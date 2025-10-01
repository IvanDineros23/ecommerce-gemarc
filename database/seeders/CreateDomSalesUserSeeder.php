<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateDomSalesUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'domsales@gemarcph.com'],
            [
                'name' => 'Dom Sales',
                'email' => 'domsales@gemarcph.com',
                'password' => Hash::make('salesdepartment'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        echo "Dom Sales user created/updated!\n";
    }
}
