<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_item' => 'IC-' . random_int(10,1000),
            'description' => fake()->paragraph(random_int(3,5)),
            'unit_price' => fake()->randomFloat(1000,100000)
        ];
    }
}
