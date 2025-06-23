<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Drop and recreate table if exists to ensure correct structure
        Schema::dropIfExists('order_items');
        
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('phone_id');
            $table->string('phone_name');
            $table->string('phone_sku')->nullable();
            $table->string('phone_color')->nullable();
            $table->string('phone_storage')->nullable();
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 15, 2); // Giá đơn vị tại thời điểm mua
            $table->decimal('total_price', 15, 2); // Tổng tiền (unit_price * quantity)
            
            // Additional columns from update migration
            $table->decimal('price', 15, 2); // Giá sản phẩm
            $table->string('color')->nullable(); // Màu sắc
            $table->decimal('total', 15, 2); // Tổng tiền
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
            
            // Indexes
            $table->index(['order_id', 'phone_id']);
        });
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Schema::dropIfExists('order_items');
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};