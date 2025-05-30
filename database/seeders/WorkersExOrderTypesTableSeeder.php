<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Worker;
use App\Models\OrderType;

class WorkersExOrderTypesTableSeeder extends Seeder
{
    public function run()
    {
        $workers = Worker::all();
        $orderTypes = OrderType::all();

        foreach ($workers as $worker) {
            $excludedTypes = $orderTypes->random(rand(1, 2)); // Исключаем 1-2 типа
            foreach ($excludedTypes as $orderType) {
                DB::table('workers_ex_order_types')->insert([
                    'worker_id' => $worker->id,
                    'order_type_id' => $orderType->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
