<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderWorker extends Model
{
    protected $table = 'order_worker';
    protected $fillable = ['order_id', 'worker_id', 'amount'];
}
