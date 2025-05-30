<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Order::factory()->count(20)->create(); // Создаём 20 заказов
    }
}
