<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderWorkerTable extends Migration
{
    public function up()
    {
        Schema::create('order_worker', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('worker_id');
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            $table->primary(['order_id', 'worker_id']);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_worker');
    }
}
