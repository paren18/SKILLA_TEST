<?php
namespace App\Services\Order;

use App\Repositories\Order\OrderWorkerRepository;

class OrderWorkerService
{
    protected $orderWorkerRepository;

    public function __construct(OrderWorkerRepository $orderWorkerRepository)
    {
        $this->orderWorkerRepository = $orderWorkerRepository;
    }

    // Метод для назначения исполнителя на заказ
    public function assignWorkerToOrder($orderId, $workerId, $amount)
    {
        return $this->orderWorkerRepository->assignWorkerToOrder($orderId, $workerId, $amount);
    }
}
