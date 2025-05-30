<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Worker extends Model
{
    protected $fillable = ['name', 'second_name', 'surname', 'phone'];

    public function rejectedOrderTypes()
    {
        return $this->hasMany(\App\Models\WorkersExOrderTypes::class, 'worker_id');
    }
}
