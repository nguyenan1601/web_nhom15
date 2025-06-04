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
        Schema::table('phones', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable(); // Sẽ thêm foreign key sau
            $table->unsignedBigInteger('brand_id')->nullable(); // Sẽ thêm foreign key sau
            $table->string('model')->nullable(); // Model cụ thể
            $table->decimal('price', 15, 0)->default(0); // Giá bán
            $table->decimal('original_price', 15, 0)->nullable(); // Giá gốc
            $table->text('description')->nullable(); // Mô tả sản phẩm
            $table->text('specifications')->nullable(); // Thông số kỹ thuật (JSON)
            $table->integer('stock_quantity')->default(0); // Số lượng tồn kho
            $table->string('color')->nullable(); // Màu sắc
            $table->string('storage')->nullable(); // Dung lượng (32GB, 64GB, 128GB...)
            $table->string('condition')->default('new'); // Tình trạng: new, refurbished, used
            $table->decimal('discount_percentage', 5, 2)->default(0); // Phần trăm giảm giá
            $table->string('warranty_period')->nullable(); // Thời gian bảo hành
            $table->string('sku')->unique()->nullable(); // Mã sản phẩm
            $table->decimal('weight', 8, 2)->nullable(); // Trọng lượng (gram)
            $table->string('operating_system')->nullable(); // Hệ điều hành
            $table->string('screen_size')->nullable(); // Kích thước màn hình
            $table->string('camera')->nullable(); // Thông tin camera
            $table->string('battery')->nullable(); // Thông tin pin
            $table->string('processor')->nullable(); // Bộ xử lý
            $table->string('ram')->nullable(); // RAM
            $table->boolean('is_available')->default(true); // Có sẵn để bán
            $table->integer('view_count')->default(0); // Số lượt xem
            $table->timestamp('released_at')->nullable(); // Ngày phát hành
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->dropColumn([
                'category_id', 'brand_id', 'model', 'price', 'original_price',
                'description', 'specifications', 'stock_quantity', 'color',
                'storage', 'condition', 'discount_percentage', 'warranty_period',
                'sku', 'weight', 'operating_system', 'screen_size', 'camera',
                'battery', 'processor', 'ram', 'is_available', 'view_count',
                'released_at'
            ]);
        });
    }
};
