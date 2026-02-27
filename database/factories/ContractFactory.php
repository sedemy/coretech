<?php

namespace Database\Factories;

use App\Enums\ContractStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'unit_name' => fake()->name(),
            'customer_name' => fake()->name(),
            'rent_amount' => fake()->randomFloat(1,3),
            'start_date' => fake()->date(),
            'end_date' =>   fake()->date(),
            'status' => ContractStatusEnum::ACTIVE,
        ];
    }
}
