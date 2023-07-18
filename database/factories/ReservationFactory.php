<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_id' => fake()->numberBetween($min = 1, $max = 30),
            'customer_id' => rand(1,200),
            'from_time' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 years'),
            'to_time' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 years'),
        ];
    }
}
