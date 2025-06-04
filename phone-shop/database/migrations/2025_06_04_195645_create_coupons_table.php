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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã giảm giá
            $table->string('name'); // Tên chương trình khuyến mãi
            $table->text('description')->nullable(); // Mô tả
            $table->enum('type', ['fixed', 'percentage'])->default('fixed'); // Loại: cố định hoặc phần trăm
            $table->decimal('value', 15, 2); // Giá trị giảm
            $table->decimal('minimum_amount', 15, 0)->nullable(); // Số tiền tối thiểu để áp dụng
            $table->decimal('maximum_discount', 15, 0)->nullable(); // Giảm tối đa (cho loại %)
            $table->integer('usage_limit')->nullable(); // Giới hạn số lần sử dụng
            $table->integer('used_count')->default(0); // Số lần đã sử dụng
            $table->integer('usage_limit_per_customer')->nullable(); // Giới hạn mỗi khách hàng
            $table->timestamp('starts_at')->nullable(); // Thời gian bắt đầu
            $table->timestamp('expires_at')->nullable(); // Thời gian kết thúc
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active'); // Trạng thái
            $table->json('applicable_categories')->nullable(); // Danh mục áp dụng
            $table->json('applicable_brands')->nullable(); // Thương hiệu áp dụng
            $table->json('applicable_products')->nullable(); // Sản phẩm áp dụng
            $table->boolean('is_public')->default(true); // Công khai hay riêng tư
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
