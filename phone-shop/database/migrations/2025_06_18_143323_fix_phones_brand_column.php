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
   public function up()
{
    Schema::table('phones', function (Blueprint $table) {
        // Bước 1: Di chuyển dữ liệu từ brand (string) sang brand_id (nếu cần)
        if (Schema::hasColumn('phones', 'brand')) {
            // Lấy danh sách brand names từ bảng phones
            $brands = DB::table('phones')->select('brand')->distinct()->pluck('brand');
            
            // Thêm brand vào bảng brands nếu chưa tồn tại
            foreach ($brands as $brandName) {
                DB::table('brands')->insertOrIgnore([
                    'name' => $brandName,
                    'slug' => Str::slug($brandName),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            // Cập nhật brand_id từ bảng brands
            DB::statement('
                UPDATE phones p
                JOIN brands b ON p.brand = b.name
                SET p.brand_id = b.id
            ');
        }

        // Bước 2: Xóa cột brand
        $table->dropColumn('brand');
    });
}

public function down()
{
    Schema::table('phones', function (Blueprint $table) {
        $table->string('brand')->nullable(); // Khôi phục cột brand (tuỳ chọn)
    });
}
};
