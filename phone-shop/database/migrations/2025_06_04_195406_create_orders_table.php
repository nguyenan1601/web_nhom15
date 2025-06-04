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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Mã đơn hàng
            $table->unsignedBigInteger('customer_id')->nullable(); // Khách hàng - sẽ thêm foreign key sau
            $table->enum('status', ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded'])
                  ->default('pending'); // Trạng thái đơn hàng
            $table->decimal('subtotal', 15, 0)->default(0); // Tổng tiền hàng
            $table->decimal('tax_amount', 15, 0)->default(0); // Tiền thuế
            $table->decimal('shipping_fee', 15, 0)->default(0); // Phí vận chuyển
            $table->decimal('discount_amount', 15, 0)->default(0); // Tiền giảm giá
            $table->decimal('total_amount', 15, 0)->default(0); // Tổng thanh toán
            $table->string('currency', 3)->default('VND'); // Đơn vị tiền tệ
            $table->enum('payment_method', ['cash', 'credit_card', 'bank_transfer', 'e_wallet', 'installment'])
                  ->nullable(); // Phương thức thanh toán
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])
                  ->default('pending'); // Trạng thái thanh toán
            $table->timestamp('paid_at')->nullable(); // Thời gian thanh toán
            
            // Thông tin giao hàng
            $table->string('shipping_first_name'); // Tên người nhận
            $table->string('shipping_last_name'); // Họ người nhận
            $table->string('shipping_phone'); // SĐT người nhận
            $table->string('shipping_email')->nullable(); // Email người nhận
            $table->text('shipping_address'); // Địa chỉ giao hàng
            $table->string('shipping_city'); // Thành phố
            $table->string('shipping_state')->nullable(); // Tỉnh/Bang
            $table->string('shipping_postal_code')->nullable(); // Mã bưu điện
            $table->string('shipping_country')->default('Vietnam'); // Quốc gia
            
            $table->text('notes')->nullable(); // Ghi chú đơn hàng
            $table->string('coupon_code')->nullable(); // Mã giảm giá
            $table->timestamp('shipped_at')->nullable(); // Thời gian giao hàng
            $table->timestamp('delivered_at')->nullable(); // Thời gian nhận hàng
            $table->json('tracking_info')->nullable(); // Thông tin theo dõi (JSON)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
