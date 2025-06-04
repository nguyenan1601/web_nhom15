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
            $table->id();
            $table->unsignedBigInteger('order_id'); // Đơn hàng - sẽ thêm foreign key sau
            $table->unsignedBigInteger('phone_id'); // Sản phẩm - sẽ thêm foreign key sau
            $table->string('phone_name'); // Tên sản phẩm tại thời điểm mua
            $table->string('phone_sku')->nullable(); // SKU sản phẩm
            $table->string('phone_color')->nullable(); // Màu sắc đã chọn
            $table->string('phone_storage')->nullable(); // Dung lượng đã chọn
            $table->decimal('unit_price', 15, 0); // Giá đơn vị tại thời điểm mua
            $table->integer('quantity')->default(1); // Số lượng
            $table->decimal('total_price', 15, 0); // Tổng giá (unit_price * quantity)
            $table->decimal('discount_amount', 15, 0)->default(0); // Giảm giá cho item này
            $table->text('warranty_info')->nullable(); // Thông tin bảo hành
            $table->string('serial_number')->nullable(); // Số serial (nếu có)
            $table->text('notes')->nullable(); // Ghi chú cho sản phẩm
            $table->timestamps();
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
