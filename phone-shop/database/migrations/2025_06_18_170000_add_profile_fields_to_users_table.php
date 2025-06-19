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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone_number');
            $table->string('avatar')->nullable()->after('address');
            $table->date('birthdate')->nullable()->after('avatar');            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('birthdate');
            $table->boolean('is_active')->default(true)->after('gender');
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone_number',
                'address',
                'avatar',
                'birthdate',                'gender',
                'is_active',
                'last_login_at'
            ]);
        });
    }
};
