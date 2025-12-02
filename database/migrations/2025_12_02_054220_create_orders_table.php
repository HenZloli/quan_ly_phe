<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('acc_manager')->onDelete('set null'); // nếu khách đăng nhập
            $table->foreignId('drink_id')->constrained('drinks')->onDelete('cascade'); // món khách chọn
            $table->integer('quantity')->default(1); // số lượng
            $table->decimal('price', 10, 2); // tổng tiền cho đơn này
            $table->string('status')->default('pending'); // trạng thái: pending, completed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
