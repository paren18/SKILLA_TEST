<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'type_id' => OrderType::inRandomOrder()->first()->id ?? 1,
            'partnership_id' => Partnership::inRandomOrder()->first()->id ?? 1,
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'description' => $this->faker->sentence(),
            'date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'address' => $this->faker->address(),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'status' => $this->faker->randomElement(['created', 'assigned', 'completed']),
        ];
    }
}
