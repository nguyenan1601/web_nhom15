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
        Schema::table('carts', function (Blueprint $table) {
            // Kiểm tra và xóa product_id nếu tồn tại
            if (Schema::hasColumn('carts', 'product_id')) {
                // Xóa column product_id (Laravel sẽ tự động xóa foreign key nếu có)
                $table->dropColumn('product_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Thêm lại product_id nếu cần rollback
            if (!Schema::hasColumn('carts', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('user_id');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            }
        });
    }
};
