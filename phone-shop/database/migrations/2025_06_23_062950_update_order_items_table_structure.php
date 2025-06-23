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
        Schema::table('order_items', function (Blueprint $table) {
            // Add columns that CheckoutController expects
            if (!Schema::hasColumn('order_items', 'price')) {
                $table->decimal('price', 15, 2)->after('phone_storage');
            }
            if (!Schema::hasColumn('order_items', 'color')) {
                $table->string('color')->nullable()->after('price');
            }
            if (!Schema::hasColumn('order_items', 'total')) {
                $table->decimal('total', 15, 2)->after('color');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['price', 'color', 'total']);
        });
    }
};
