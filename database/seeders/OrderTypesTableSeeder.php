<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_types')->insert([
            ['name' => 'Погрузка/Разгрузка', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Такелажные работы', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Уборка', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
