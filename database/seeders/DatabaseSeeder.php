<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Table::factory()->count(30)->create();
        Meal::factory()->count(100)->create();
        Customer::factory()->count(200)->create();
        Reservation::factory()->count(300)->create();
        Order::factory()->count(300)->create();
    }
}
