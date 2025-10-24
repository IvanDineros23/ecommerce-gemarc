<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmployeeRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Purchasing Employee', 'email' => 'purchasing@gemarc.com', 'department' => 'purchasing', 'role' => 'employee'],
            ['name' => 'Accounting Employee', 'email' => 'accounting@gemarc.com', 'department' => 'accounting', 'role' => 'employee'],
            ['name' => 'Technical Employee', 'email' => 'technical@gemarc.com', 'department' => 'technical', 'role' => 'employee'],
        ];
        foreach ($roles as $data) {
            DB::table('users')->updateOrInsert(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make('password123'),
                    'department' => $data['department'],
                    'role' => $data['role'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
