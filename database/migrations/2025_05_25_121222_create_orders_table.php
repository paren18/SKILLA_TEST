<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('order_types');
            $table->foreignId('partnership_id')->constrained('partnerships');
            $table->foreignId('user_id')->constrained('users');
            $table->text('description');
            $table->date('date');
            $table->string('address');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['created', 'assigned', 'completed'])->default('created');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
