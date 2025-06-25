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
            // Xoá khóa ngoại và cột product_id nếu tồn tại
            // if (Schema::hasColumn('carts', 'product_id')) {
            //     $table->dropForeign(['product_id']);
            //     $table->dropColumn('product_id');
            // }

            // Thêm cột phone_id trước khi đặt foreign key
            $table->unsignedBigInteger('phone_id')->after('user_id');    

            // Thêm các trường mới
            $table->string('color', 50)->after('quantity');
            $table->string('session_id')->nullable()->after('color');

            // Cho phép user_id nullable để hỗ trợ guest users
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Foreign key
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');

            // Thêm index
            $table->index(['user_id', 'phone_id', 'color']);
            $table->index('session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Drop foreign & index
            $table->dropForeign(['phone_id']);
            $table->dropIndex(['carts_user_id_phone_id_color_index']);
            $table->dropIndex(['carts_session_id_index']);

            // Drop cột mới
            $table->dropColumn(['phone_id', 'color', 'session_id']);

            // Khôi phục user_id như cũ
            $table->unsignedBigInteger('user_id')->nullable(false)->change();

            // Thêm lại product_id
            $table->foreignId('product_id')->after('user_id')->constrained()->onDelete('cascade');
        });
    }
};
