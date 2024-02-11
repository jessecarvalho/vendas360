<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::factory()
            ->count(3)
            ->create();
    }
}
