<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('workers')->insert([
            ['name' => 'Иван', 'second_name' => 'Иванов', 'surname' => 'Иван', 'phone' => '1234567890', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Петр', 'second_name' => 'Петров', 'surname' => 'Петр', 'phone' => '9876543210', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Сергей', 'second_name' => 'Сергеев', 'surname' => 'Сергей', 'phone' => '1122334455', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
