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
        Schema::create('phone_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_id'); // Sản phẩm - sẽ thêm foreign key sau
            $table->string('image_url'); // Đường dẫn hình ảnh
            $table->string('alt_text')->nullable(); // Văn bản thay thế
            $table->boolean('is_primary')->default(false); // Ảnh chính
            $table->integer('sort_order')->default(0); // Thứ tự sắp xếp
            $table->enum('type', ['main', 'gallery', 'thumbnail', 'color_variant'])
                  ->default('gallery'); // Loại ảnh
            $table->string('color_code')->nullable(); // Mã màu nếu là ảnh biến thể màu
            $table->json('metadata')->nullable(); // Thông tin meta (kích thước, format, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_images');
    }
};
