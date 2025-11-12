<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                Order::create([
                    'user_id' => $user->id,
                    'status' => $faker->randomElement(['pending', 'paid', 'processing', 'cancelled']),
                    'total_amount' => $faker->randomFloat(2, 100, 1000),
                    'remarks' => $faker->sentence,
                ]);
            }
        }
    }
}