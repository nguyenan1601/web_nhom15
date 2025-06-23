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
            // Thay đổi product_id thành phone_id
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            
            // Thêm các trường mới
            $table->unsignedBigInteger('phone_id')->after('user_id');
            $table->string('color', 50)->after('quantity');
            $table->string('session_id')->nullable()->after('color');
            
            // Cho phép user_id nullable để hỗ trợ guest users
            $table->unsignedBigInteger('user_id')->nullable()->change();
            
            // Thêm foreign key mới
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
            
            // Thêm index cho hiệu suất
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
            // Rollback changes
            $table->dropForeign(['phone_id']);
            $table->dropIndex(['user_id', 'phone_id', 'color']);
            $table->dropIndex(['session_id']);
            
            $table->dropColumn(['phone_id', 'color', 'session_id']);
            
            // Restore original structure
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->foreignId('product_id')->after('user_id')->constrained()->onDelete('cascade');
        });
    }
};
