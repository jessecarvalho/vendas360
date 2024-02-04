<?php

namespace Database\Seeders;

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
        for ($i = 0; $i < 3; $i++) {
            DB::table('sellers')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
            ]);
        }
    }
}
