<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dishes')->insert([
            [
                "name" => "Massa",
                "parent_id" => null,
            ],
            [
                "name" => "Bolo de Chocolate",
                "parent_id" => null,
            ],
            [
                "name" => "Lasanha",
                "parent_id" => 1,
            ]
        ]);
    }
}
