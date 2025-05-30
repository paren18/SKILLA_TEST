<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnershipsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('partnerships')->insert([
            ['name' => 'Компания VILKA', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Компания STUL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Компания не знаю', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
