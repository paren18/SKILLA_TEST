<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkersExOrderTypes extends Model
{
    protected $table = 'workers_ex_order_types';

    protected $fillable = ['worker_id', 'order_type_id'];

    // Связь с таблицей workers
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    public function orderType()
    {
        return $this->belongsTo(OrderType::class, 'order_type_id');
    }
}
