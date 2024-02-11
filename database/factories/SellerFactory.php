<?php

namespace Database\Factories;

use App\Models\Seller;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();

        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
        ];
    }
}
