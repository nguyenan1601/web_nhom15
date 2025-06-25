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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Khách hàng - sẽ thêm foreign key sau
            $table->unsignedBigInteger('phone_id'); // Sản phẩm - sẽ thêm foreign key sau
            $table->timestamp('added_at')->useCurrent(); // Thời gian thêm vào wishlist
            $table->text('notes')->nullable(); // Ghi chú cá nhân
            $table->boolean('is_notified_price_drop')->default(true); // Thông báo khi giảm giá
            $table->decimal('desired_price', 15, 0)->nullable(); // Giá mong muốn
            $table->timestamps();
            
            // Đảm bảo mỗi khách hàng chỉ thêm 1 lần cho 1 sản phẩm
            $table->unique(['customer_id', 'phone_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
