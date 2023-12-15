<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => uuid_create(),
            'date' => fake()->dateTime(),
            'due_date' => fake()->dateTime(),
            'reference' => 'REF-' . random_int(10,1000),
            'term_and_condition' => fake()->paragraph(),
            'sub_total' => fake()->randomFloat(random_int(0,3),20000,100000),
            'discount' => fake()->randomFloat(random_int(0,2),1000,10000),
            'total' => fake()->randomFloat(random_int(0,3),20000,200000)
        ];
    }
}
