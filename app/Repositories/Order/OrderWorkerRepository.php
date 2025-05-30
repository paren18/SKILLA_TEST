<?php


namespace App\Repositories\Order;

use App\Models\Order;
use App\Models\Worker;
use App\Models\WorkersExOrderTypes;

class OrderWorkerRepository
{
    // Метод для назначения исполнителя на заказ
    public function assignWorkerToOrder($orderId, $workerId, $amount)
    {
        $order = Order::findOrFail($orderId);
        $worker = Worker::findOrFail($workerId);

        // Проверяем, отказался ли исполнитель от типа заказа
        $rejectedTypes = WorkersExOrderTypes::where('worker_id', $workerId)
            ->pluck('order_type_id')
            ->toArray();

        if (in_array($order->type_id, $rejectedTypes)) {
            return false; // Исполнитель отказался от этого типа заказа
        }

        // Если не отказался, создаём связь между заказом и исполнителем
        $order->workers()->attach($workerId, ['amount' => $amount]);

        return true; // Исполнитель успешно назначен на заказ
    }
}
