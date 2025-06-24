<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
<<<<<<< Updated upstream
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->unsignedInteger('quantity');
        $table->decimal('price', 10, 2); // giá tại thời điểm mua
        $table->timestamps();
=======
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('phone_id');
            $table->string('phone_name');
            $table->string('phone_sku')->nullable();
            $table->string('phone_color')->nullable();
            $table->string('phone_storage')->nullable();
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 15, 2); // Giá đơn vị
            $table->decimal('total_price', 15, 2); // Tổng tiền (unit_price * quantity)
            $table->decimal('discount_amount', 15, 2)->default(0); // Số tiền giảm giá
            $table->string('warranty_info')->nullable(); // Thông tin bảo hành
            $table->string('serial_number')->nullable(); // Số serial
            $table->text('notes')->nullable(); // Ghi chú
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
            
            // Indexes
            $table->index(['order_id', 'phone_id']);
>>>>>>> Stashed changes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
