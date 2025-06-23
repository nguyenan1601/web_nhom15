<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Gộp tất cả thay đổi cho bảng phones
     */
    public function up(): void
    {
        // Chỉ thực hiện nếu bảng phones chưa có đầy đủ cột
        if (!Schema::hasColumn('phones', 'detail_image_path')) {
            Schema::table('phones', function (Blueprint $table) {
                // Thêm detail_image_path nếu chưa có
                $table->string('detail_image_path')->nullable()->after('image_path');
            });
        }
        
        // Đảm bảo tất cả cột cần thiết đều có
        Schema::table('phones', function (Blueprint $table) {
            // Kiểm tra và thêm các cột nếu chưa có
            if (!Schema::hasColumn('phones', 'featured')) {
                $table->boolean('featured')->default(false)->after('brand');
            }
            if (!Schema::hasColumn('phones', 'status')) {
                $table->enum('status', ['active', 'inactive', 'out_of_stock'])->default('active')->after('featured');
            }
            if (!Schema::hasColumn('phones', 'original_price')) {
                $table->decimal('original_price', 15, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('phones', 'discount_percentage')) {
                $table->decimal('discount_percentage', 5, 2)->default(0)->after('original_price');
            }
            if (!Schema::hasColumn('phones', 'condition')) {
                $table->enum('condition', ['new', 'refurbished', 'used'])->default('new')->after('storage');
            }
            if (!Schema::hasColumn('phones', 'warranty_period')) {
                $table->string('warranty_period')->nullable()->after('condition');
            }
            if (!Schema::hasColumn('phones', 'sku')) {
                $table->string('sku')->unique()->after('model');
            }
            if (!Schema::hasColumn('phones', 'weight')) {
                $table->decimal('weight', 8, 2)->nullable()->after('sku');
            }
            if (!Schema::hasColumn('phones', 'operating_system')) {
                $table->string('operating_system')->nullable()->after('weight');
            }
            if (!Schema::hasColumn('phones', 'screen_size')) {
                $table->string('screen_size')->nullable()->after('operating_system');
            }
            if (!Schema::hasColumn('phones', 'camera')) {
                $table->text('camera')->nullable()->after('screen_size');
            }
            if (!Schema::hasColumn('phones', 'battery')) {
                $table->string('battery')->nullable()->after('camera');
            }
            if (!Schema::hasColumn('phones', 'processor')) {
                $table->string('processor')->nullable()->after('battery');
            }
            if (!Schema::hasColumn('phones', 'ram')) {
                $table->string('ram')->nullable()->after('processor');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phones', function (Blueprint $table) {
            $table->dropColumn([
                'detail_image_path',
                'featured',
                'status', 
                'original_price',
                'discount_percentage',
                'condition',
                'warranty_period',
                'sku',
                'weight',
                'operating_system',
                'screen_size',
                'camera',
                'battery',
                'processor',
                'ram'
            ]);
        });
    }
};
