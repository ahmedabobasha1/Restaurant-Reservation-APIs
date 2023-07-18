<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_id' => rand(1,30),
            'reservation_id' => rand(1,300),
            'customer_id' => rand(1,200),
            'waiter_id' => rand(1,30),
            'total' => rand(50,10000),
            'date' =>fake()->dateTimeBetween($startDate = 'now', $endDate ='+1 years')
        ];
    }
}
