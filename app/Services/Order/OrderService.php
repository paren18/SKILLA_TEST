<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $data)
    {
        return $this->orderRepository->create($data);
    }

}
