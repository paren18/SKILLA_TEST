<?php
namespace App\Repositories;

use App\Models\Worker;

class WorkerRepository
{
    public function filterByOrderTypes(array $typeIds)
    {
        return Worker::where(function ($query) use ($typeIds) {
            foreach ($typeIds as $typeId) {
                $query->orWhereDoesntHave('rejectedOrderTypes', function ($q) use ($typeId) {
                    $q->where('order_type_id', $typeId);
                });
            }
        })->get();
    }
}
