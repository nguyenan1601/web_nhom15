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
        Schema::create('carts', function (Blueprint $table) {
<<<<<<< Updated upstream
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->unsignedInteger('quantity')->default(1);
        $table->timestamps();
=======
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable cho guest users
            $table->unsignedBigInteger('phone_id');
            $table->unsignedInteger('quantity')->default(1);
            $table->string('color', 50);
            $table->string('session_id')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');

            // Indexes
            $table->index(['user_id', 'phone_id', 'color']);
            $table->index('session_id');
>>>>>>> Stashed changes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
