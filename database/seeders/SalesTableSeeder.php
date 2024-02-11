<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    public function run()
    {
        Sale::factory()
            ->count(15)
            ->create();
    }
}
