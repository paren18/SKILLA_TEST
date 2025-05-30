<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderWorker;

class OrderWorkerTableSeeder extends Seeder
{
    public function run()
    {
        $orders = \App\Models\Order::all();  // Все заказы
        $workers = \App\Models\Worker::all();  // Все исполнители

        foreach ($orders as $order) {
            // Привязываем от 1 до 3 исполнителей к каждому заказу
            $workersToAssign = $workers->random(rand(1, 3));

            foreach ($workersToAssign as $worker) {
                OrderWorker::create([
                    'order_id' => $order->id,
                    'worker_id' => $worker->id,
                    'amount' => rand(100, 1000),
                ]);
            }
        }
    }
}
