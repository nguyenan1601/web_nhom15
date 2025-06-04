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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Tên thương hiệu
            $table->string('slug')->unique(); // Slug cho URL
            $table->text('description')->nullable(); // Mô tả thương hiệu
            $table->string('logo')->nullable(); // Logo thương hiệu
            $table->string('country')->nullable(); // Quốc gia
            $table->string('website')->nullable(); // Website chính thức
            $table->string('status')->default('active'); // Trạng thái: active, inactive
            $table->integer('sort_order')->default(0); // Thứ tự sắp xếp
            $table->boolean('is_featured')->default(false); // Thương hiệu nổi bật
            $table->json('meta_data')->nullable(); // Dữ liệu meta (JSON)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
