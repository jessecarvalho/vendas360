<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Sale;
use App\Models\Seller;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        $faker = Faker::create();

        $value = $faker->randomFloat(2, 0, 1000);
        $commission = $value * 0.1;

        return [
            'value' => $value,
            'date' => $faker->dateTimeThisYear(),
            'commission' => $commission,
            'seller_id' => function () {
                return Seller::factory()->create()->id;
            },
        ];
    }
}
