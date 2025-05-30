<?php


namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class OrderWorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function assignWorkerToOrder(Request $request, $orderId)
    {
        $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'amount' => 'required|numeric',
        ]);

        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $worker = Worker::find($request->worker_id);
        if (!$worker) {
            return response()->json(['error' => 'Worker not found'], 404);
        }
        
        $rejected = $worker->rejectedOrderTypes()->pluck('order_type_id')->toArray();
        if (in_array($order->type_id, $rejected)) {
            return response()->json(['error' => 'Исполнитель отказался от этого типа заказа'], 400);
        }

        if ($order->workers()->where('worker_id', $worker->id)->exists()) {
            return response()->json(['error' => 'Этот исполнитель уже назначен на заказ'], 400);
        }

        // Назначение
        $order->workers()->attach($worker->id, ['amount' => $request->amount]);

        return response()->json(['message' => 'Исполнитель успешно назначен на заказ'], 200);
    }

}

