<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id', 'partnership_id', 'user_id', 'description', 'date', 'address', 'amount', 'status'
    ];

    public function orderType()
    {
        return $this->belongsTo(OrderType::class, 'type_id');
    }

    public function partnership()
    {
        return $this->belongsTo(Partnership::class, 'partnership_id');
    }

    public function workers()
    {
        return $this->belongsToMany(Worker::class, 'order_worker', 'order_id', 'worker_id')
            ->withPivot('amount')  // Для доступа к дополнительным полям в таблице pivot
            ->withTimestamps();    // Если в таблице есть timestamps (created_at, updated_at)
    }
}

