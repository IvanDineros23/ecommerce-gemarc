<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DevUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'helpdesk@gemarcph.com',
                'password' => Hash::make('Ivandineros23!'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kitona Employee',
                'email' => 'kitona@gemarcph.com',
                'password' => Hash::make('salesdepartment'),
                'role' => 'employee',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dom Sales',
                'email' => 'domsales@gemarcph.com',
                'password' => Hash::make('salesdepartment'),
                'role' => 'employee',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
