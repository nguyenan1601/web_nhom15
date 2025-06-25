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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_id'); // Sản phẩm - sẽ thêm foreign key sau
            $table->unsignedBigInteger('customer_id'); // Khách hàng - sẽ thêm foreign key sau
            $table->unsignedBigInteger('order_id')->nullable(); // Đơn hàng liên quan - sẽ thêm foreign key sau
            $table->integer('rating')->check('rating >= 1 AND rating <= 5'); // Điểm đánh giá (1-5 sao)
            $table->string('title')->nullable(); // Tiêu đề đánh giá
            $table->text('comment')->nullable(); // Nội dung đánh giá
            $table->json('pros')->nullable(); // Ưu điểm (array)
            $table->json('cons')->nullable(); // Nhược điểm (array)
            $table->boolean('is_verified_purchase')->default(false); // Đã mua hàng xác thực
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Trạng thái
            $table->integer('helpful_count')->default(0); // Số người thấy hữu ích
            $table->integer('not_helpful_count')->default(0); // Số người không thấy hữu ích
            $table->timestamp('reviewed_at')->nullable(); // Thời gian đánh giá
            $table->text('admin_response')->nullable(); // Phản hồi từ admin
            $table->timestamp('admin_response_at')->nullable(); // Thời gian phản hồi
            $table->json('review_images')->nullable(); // Hình ảnh đính kèm
            $table->timestamps();
            
            // Đảm bảo mỗi khách hàng chỉ đánh giá 1 lần cho 1 sản phẩm
            $table->unique(['phone_id', 'customer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
