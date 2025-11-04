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
        // Create demo users with roles
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateEmployeeUserSeeder::class);
        $this->call(CreateNormalUserSeeder::class);
        $this->call(TipsSeeder::class);    // Seed Dom Sales employee
    $this->call(CreateDomSalesUserSeeder::class);

    // Seed demo products and images for MVP
    $this->call(\Database\Seeders\CreateDemoProductsSeeder::class);
    }
}
