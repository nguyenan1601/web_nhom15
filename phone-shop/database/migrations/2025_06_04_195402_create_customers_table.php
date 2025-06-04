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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Tên
            $table->string('last_name'); // Họ
            $table->string('email')->unique(); // Email
            $table->timestamp('email_verified_at')->nullable(); // Xác thực email
            $table->string('phone')->nullable(); // Số điện thoại
            $table->date('date_of_birth')->nullable(); // Ngày sinh
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Giới tính
            $table->string('password'); // Mật khẩu
            $table->text('address')->nullable(); // Địa chỉ
            $table->string('city')->nullable(); // Thành phố
            $table->string('state')->nullable(); // Tỉnh/Bang
            $table->string('postal_code')->nullable(); // Mã bưu điện
            $table->string('country')->default('Vietnam'); // Quốc gia
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active'); // Trạng thái
            $table->timestamp('last_login_at')->nullable(); // Lần đăng nhập cuối
            $table->string('avatar')->nullable(); // Ảnh đại diện
            $table->boolean('is_verified')->default(false); // Đã xác thực
            $table->json('preferences')->nullable(); // Tùy chọn cá nhân (JSON)
            $table->rememberToken(); // Token nhớ đăng nhập
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
