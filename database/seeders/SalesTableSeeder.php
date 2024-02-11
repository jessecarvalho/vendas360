<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SalesTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 12; $i++) {

            $seller = DB::table('sellers')->inRandomOrder()->first();

            DB::table('sales')->insert([
                'value' => rand(100, 1000),
                'date' => now(),
                'commission' => rand(10, 100),
                'seller_id' => $seller->id,
            ]);
        }
    }
}
