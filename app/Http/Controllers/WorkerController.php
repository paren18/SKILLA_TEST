<?php

namespace App\Http\Controllers;

use App\Services\WorkerService;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    protected $workerService;

    public function __construct(WorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    public function filterByOrderTypes(Request $request)
    {
        $typeIds = $request->input('order_type_ids');

        $request->validate([
            'order_type_ids' => 'required|array',
            'order_type_ids.*' => 'integer|exists:order_types,id',
        ]);

        // Получаем отфильтрованных исполнителей
        $workers = $this->workerService->filterByOrderTypes($typeIds);

        return response()->json($workers);
    }
}
