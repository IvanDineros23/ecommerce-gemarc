<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Seed admin, employee, and normal user accounts
    $this->call(CreateAdminUserSeeder::class);
    $this->call(CreateEmployeeUserSeeder::class);
    $this->call(CreateNormalUserSeeder::class);

    // Seed demo products and images for MVP
    $this->call(\Database\Seeders\CreateDemoProductsSeeder::class);
    }
}
