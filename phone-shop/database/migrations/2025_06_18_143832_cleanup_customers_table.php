<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->dropColumn(['email', 'password', 'email_verified_at', 'remember_token']);
    });
}

public function down()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->string('email')->unique();
        $table->string('password');
        $table->timestamp('email_verified_at')->nullable();
        $table->rememberToken();
    });
}
};
