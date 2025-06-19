<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/[timestamp]_add_user_id_to_customers_table.php
public function up()
{
    Schema::table('customers', function (Blueprint $table) {
        // Thêm cột user_id và ràng buộc khóa ngoại
        $table->unsignedBigInteger('user_id')->unique()->after('id');
        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade'); // Xóa customer khi user bị xóa
    });

    // Đồng bộ dữ liệu từ users sang customers (nếu cần)
    if (Schema::hasTable('users') && Schema::hasTable('customers')) {
        DB::table('users')->orderBy('id')->chunk(100, function ($users) {
            foreach ($users as $user) {
                DB::table('customers')
                    ->where('email', $user->email)
                    ->update(['user_id' => $user->id]);
            }
        });
    }
}

public function down()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
