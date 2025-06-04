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
        // Thêm foreign keys cho bảng phones
        Schema::table('phones', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });

        // Thêm foreign keys cho bảng orders
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });

        // Thêm foreign keys cho bảng order_items
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
        });

        // Thêm foreign keys cho bảng phone_images
        Schema::table('phone_images', function (Blueprint $table) {
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
        });

        // Thêm foreign keys cho bảng reviews
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        });

        // Thêm foreign keys cho bảng wishlists
        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa foreign keys theo thứ tự ngược lại
        Schema::table('wishlists', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['phone_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['phone_id']);
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['order_id']);
        });

        Schema::table('phone_images', function (Blueprint $table) {
            $table->dropForeign(['phone_id']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['phone_id']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });

        Schema::table('phones', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['brand_id']);
        });
    }
};
