<?php

namespace Database\Factories;

use App\Models\OrderWorker;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderWorkerFactory extends Factory
{
    protected $model = OrderWorker::class;

    public function definition()
    {
        return [
            'order_id' => \App\Models\Order::inRandomOrder()->first()->id,
            'worker_id' => \App\Models\Worker::inRandomOrder()->first()->id,
            'amount' => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}
