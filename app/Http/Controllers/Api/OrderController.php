<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Order\OrderService;
use App\Repositories\Order\OrderRepository;

class OrderController extends Controller
{
    protected $orderService;
    protected $orderRepository;

    public function __construct(OrderService $orderService, OrderRepository $orderRepository)
    {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_id' => 'required|exists:order_types,id',
            'partnership_id' => 'required|exists:partnerships,id',
            'description' => 'required|string',
            'date' => 'required|date',
            'address' => 'required|string',
            'amount' => 'required|numeric',
            'status' => 'in:created,assigned,completed'
        ]);


        $validated['user_id'] = $request->user()->id;

        $order = $this->orderService->createOrder($validated);

        return response()->json(['order' => $order], 201);
    }

}
