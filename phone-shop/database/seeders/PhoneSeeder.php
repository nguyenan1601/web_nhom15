<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phone;
<<<<<<< Updated upstream
use Illuminate\Support\Str;
=======
use App\Models\Brand;
use App\Models\Category;
>>>>>>> Stashed changes

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy brand và category ids
        $appleBrand = Brand::where('name', 'Apple')->first();
        $samsungBrand = Brand::where('name', 'Samsung')->first();
        $category = Category::where('name', 'Smartphone Cao Cấp')->first();

        $phones = [
            [
                'name' => 'iPhone 15 Pro Max',
                'brand' => 'Apple',
                'featured' => true,
                'status' => 'active',
<<<<<<< Updated upstream
                'category_id' => 1, // Smartphone Cao Cấp
                'brand_id' => 1, // Apple
=======
                'category_id' => $category ? $category->id : 1,
                'brand_id' => $appleBrand ? $appleBrand->id : 1,
>>>>>>> Stashed changes
                'model' => 'A3108',
                'price' => 34990000,
                'original_price' => 36990000,
                'description' => 'iPhone 15 Pro Max với chip A17 Pro, camera 48MP và thân máy titan',
                'stock_quantity' => 50,
                'color' => 'Natural Titanium',
                'storage' => '256GB',
                'condition' => 'new',
                'discount_percentage' => 5.41,
                'warranty_period' => '12 tháng',
                'sku' => 'IP15PM-256-NT',
                'weight' => 221.0,
                'operating_system' => 'iOS 17',
                'screen_size' => '6.7 inch',
                'camera' => '48MP Main + 12MP Ultra Wide + 12MP Telephoto',
                'battery' => '4441 mAh',
<<<<<<< Updated upstream
                'processor' => 'Apple A17 Pro',
                'ram' => '8GB',
                'is_available' => true,
                'view_count' => 1250,
                'released_at' => '2023-09-22'
=======
                'processor' => 'A17 Pro',
                'ram' => '8GB',                'image_path' => 'images/iPhone 15 Pro Max crop.png',
                'detail_image_path' => 'images/iPhone 15 Pro Max detail.png'
>>>>>>> Stashed changes
            ],
            [
                'name' => 'iPhone 15',
                'brand' => 'Apple',
                'featured' => true,
                'status' => 'active',
                'category_id' => $category ? $category->id : 1,
                'brand_id' => $appleBrand ? $appleBrand->id : 1,
                'model' => 'A3089',
                'price' => 22990000,
                'original_price' => 24990000,
                'description' => 'iPhone 15 với chip A16 Bionic và camera 48MP chất lượng cao',
                'stock_quantity' => 30,
                'color' => 'Pink',
                'storage' => '128GB',
                'condition' => 'new',
                'discount_percentage' => 8.0,
                'warranty_period' => '12 tháng',
                'sku' => 'IP15-128-PK',
                'weight' => 171.0,
                'operating_system' => 'iOS 17',
                'screen_size' => '6.1 inch',
<<<<<<< Updated upstream
                'camera' => '12MP Main + 12MP Ultra Wide',
                'battery' => '3279 mAh',
                'processor' => 'Apple A15 Bionic',
                'ram' => '6GB',
                'is_available' => true,
                'view_count' => 890,
                'released_at' => '2022-09-16'
=======
                'camera' => '48MP Main + 12MP Ultra Wide',
                'battery' => '3349 mAh',
                'processor' => 'A16 Bionic',
                'ram' => '6GB',                'image_path' => 'images/iPhone 14 crop.png',
                'detail_image_path' => 'images/iPhone 14 detail.png'
>>>>>>> Stashed changes
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'brand' => 'Samsung',
                'featured' => true,
                'status' => 'active',
<<<<<<< Updated upstream
                'category_id' => 1,
                'brand_id' => 2, // Samsung
                'model' => 'SM-S928B',
                'price' => 33990000,
                'original_price' => 35990000,
                'description' => 'Galaxy S24 Ultra với S Pen tích hợp, camera 200MP và AI Galaxy',
                'specifications' => json_encode([
                    'screen' => '6.8" Dynamic AMOLED 2X',
                    'resolution' => '3120 x 1440 pixels',
                    'chip' => 'Snapdragon 8 Gen 3 for Galaxy',
                    'rear_camera' => '200MP + 50MP + 12MP + 10MP',
                    'front_camera' => '12MP',
                    'battery' => '5000 mAh',
                    'charging' => '45W Type-C + 15W Wireless',
                    'sim' => 'Nano SIM + eSIM',
                    'os' => 'Android 14, One UI 6.1'
                ]),
                'stock_quantity' => 40,
                'color' => 'Titanium Black',
=======
                'category_id' => $category ? $category->id : 1,
                'brand_id' => $samsungBrand ? $samsungBrand->id : 2,
                'model' => 'SM-S928',
                'price' => 32990000,
                'original_price' => 34990000,
                'description' => 'Galaxy S24 Ultra với S Pen, camera 200MP và màn hình Dynamic AMOLED 2X',
                'stock_quantity' => 25,
                'color' => 'Titanium Gray',
>>>>>>> Stashed changes
                'storage' => '256GB',
                'condition' => 'new',
                'discount_percentage' => 5.7,
                'warranty_period' => '12 tháng',
                'sku' => 'S24U-256-TG',
                'weight' => 232.0,
                'operating_system' => 'Android 14',
                'screen_size' => '6.8 inch',
                'camera' => '200MP Main + 50MP Periscope + 12MP Ultra Wide + 10MP Telephoto',
                'battery' => '5000 mAh',
                'processor' => 'Snapdragon 8 Gen 3',
<<<<<<< Updated upstream
                'ram' => '12GB',
                'is_available' => true,
                'view_count' => 1100,
                'released_at' => '2024-01-24'
=======
                'ram' => '12GB',                'image_path' => 'images/Samsung Galaxy S24 Ultra crop.png',
                'detail_image_path' => 'images/Samsung Galaxy S24 Ultra detail.png'
>>>>>>> Stashed changes
            ],
            [
                'name' => 'iPhone 14 Pro',
                'brand' => 'Apple',
                'featured' => true,
                'status' => 'active',
                'category_id' => $category ? $category->id : 1,
                'brand_id' => $appleBrand ? $appleBrand->id : 1,
                'model' => 'A2894',
                'price' => 27990000,
                'original_price' => 29990000,
                'description' => 'iPhone 14 Pro với chip A16 Bionic và Dynamic Island',
                'stock_quantity' => 40,
                'color' => 'Deep Purple',
                'storage' => '128GB',
                'condition' => 'new',
                'discount_percentage' => 6.67,
                'warranty_period' => '12 tháng',
                'sku' => 'IP14P-128-DP',
                'weight' => 206.0,
                'operating_system' => 'iOS 16',
                'screen_size' => '6.1 inch',
                'camera' => '48MP Main + 12MP Ultra Wide + 12MP Telephoto',
                'battery' => '3200 mAh',
                'processor' => 'A16 Bionic',
                'ram' => '6GB',
                'image_path' => 'images/iPhone 14 crop.png',
                'detail_image_path' => 'images/iPhone 14 detail.png'
            ],
            [
                'name' => 'Samsung Galaxy A54',
                'brand' => 'Samsung',
                'featured' => false,
                'status' => 'active',
<<<<<<< Updated upstream
                'category_id' => 2, // Smartphone Tầm Trung
                'brand_id' => 2,
                'model' => 'SM-A556B',
                'price' => 10490000,
=======
                'category_id' => $category ? $category->id : 1,
                'brand_id' => $samsungBrand ? $samsungBrand->id : 2,
                'model' => 'SM-A546',
                'price' => 10990000,
>>>>>>> Stashed changes
                'original_price' => 11990000,
                'description' => 'Galaxy A54 với camera OIS và màn hình Super AMOLED',
                'stock_quantity' => 60,
                'color' => 'Awesome Violet',
                'storage' => '128GB',
                'condition' => 'new',
                'discount_percentage' => 8.34,
                'warranty_period' => '12 tháng',
                'sku' => 'A54-128-AV',
                'weight' => 202.0,
                'operating_system' => 'Android 13',
                'screen_size' => '6.4 inch',
                'camera' => '50MP Main + 12MP Ultra Wide + 5MP Macro',
                'battery' => '5000 mAh',
<<<<<<< Updated upstream
                'processor' => 'Exynos 1480',
                'ram' => '8GB',
                'is_available' => true,
                'view_count' => 450,
                'released_at' => '2024-03-11'
=======
                'processor' => 'Exynos 1380',
                'ram' => '8GB',                'image_path' => 'images/Galaxy A54 crop.png',
                'detail_image_path' => 'images/iPhone 14 detail.png'  // Sử dụng ảnh có sẵn
>>>>>>> Stashed changes
            ],
            [
                'name' => 'Xiaomi 14 Ultra',
                'brand' => 'Xiaomi',
                'featured' => true,
                'status' => 'active',
<<<<<<< Updated upstream
                'category_id' => 1,
                'brand_id' => 3, // Xiaomi
                'model' => '2405CPX3DG',
                'price' => 29990000,
                'original_price' => 31990000,
                'description' => 'Xiaomi 14 Ultra với hệ thống camera Leica 4 ống kính chuyên nghiệp',
                'specifications' => json_encode([
                    'screen' => '6.73" LTPO AMOLED',
                    'resolution' => '3200 x 1440 pixels',
                    'chip' => 'Snapdragon 8 Gen 3',
                    'rear_camera' => '50MP + 50MP + 50MP + 50MP',
                    'front_camera' => '32MP',
                    'battery' => '5300 mAh',
                    'charging' => '90W Type-C + 80W Wireless',
                    'sim' => 'Nano SIM + eSIM',
                    'os' => 'Android 14, HyperOS'
                ]),
                'stock_quantity' => 30,
=======
                'category_id' => $category ? $category->id : 1,
                'brand_id' => 3, // Assuming Xiaomi brand id
                'model' => '2306EPN60G',
                'price' => 14990000,
                'original_price' => 16990000,
                'description' => 'Xiaomi 13T Pro với MediaTek Dimensity 9200+ và sạc nhanh 120W',
                'stock_quantity' => 35,
>>>>>>> Stashed changes
                'color' => 'Black',
                'storage' => '256GB',
                'condition' => 'new',
                'discount_percentage' => 11.77,
                'warranty_period' => '18 tháng',
<<<<<<< Updated upstream
                'sku' => 'XM14U-512-BK',
                'weight' => 229.0,
                'operating_system' => 'Android 14',
                'screen_size' => '6.73 inch',
                'camera' => '50MP Main + 50MP Ultra Wide + 50MP Periscope + 50MP Portrait',
                'battery' => '5300 mAh',
                'processor' => 'Snapdragon 8 Gen 3',
                'ram' => '16GB',
                'is_available' => true,
                'view_count' => 680,
                'released_at' => '2024-02-25'
            ],
            [
                'name' => 'Xiaomi Redmi Note 13',
                'brand' => 'Xiaomi',
                'featured' => false,
                'status' => 'active',
                'category_id' => 3, // Smartphone Giá Rẻ
                'brand_id' => 3,
                'model' => '23124RN87G',
                'price' => 4990000,
                'original_price' => 5490000,
                'description' => 'Redmi Note 13 với camera 108MP và pin 5000mAh bền bỉ',
                'specifications' => json_encode([
                    'screen' => '6.67" AMOLED',
                    'resolution' => '2400 x 1080 pixels',
                    'chip' => 'Snapdragon 685 8-core',
                    'rear_camera' => '108MP + 8MP + 2MP',
                    'front_camera' => '16MP',
                    'battery' => '5000 mAh',
                    'charging' => '33W Type-C',
                    'sim' => 'Dual Nano SIM',
                    'os' => 'Android 13, MIUI 14'
                ]),
                'stock_quantity' => 200,
                'color' => 'Mint Green',
                'storage' => '128GB',
                'condition' => 'new',
                'discount_percentage' => 9.11,
                'warranty_period' => '12 tháng',
                'sku' => 'RN13-128-MG',
                'weight' => 188.0,
=======
                'sku' => 'X13TP-256-BK',
                'weight' => 206.0,
>>>>>>> Stashed changes
                'operating_system' => 'Android 13',
                'screen_size' => '6.67 inch',
                'camera' => '50MP Main + 50MP Telephoto + 12MP Ultra Wide',
                'battery' => '5000 mAh',
<<<<<<< Updated upstream
                'processor' => 'Snapdragon 685',
                'ram' => '6GB',
                'is_available' => true,
                'view_count' => 750,
                'released_at' => '2024-01-15'
=======
                'processor' => 'MediaTek Dimensity 9200+',
                'ram' => '12GB',                'image_path' => 'images/Xiaomi 14 Ultra crop.png',
                'detail_image_path' => 'images/Xiaomi 14 Ultra detail.png'
            ],
            [
                'name' => 'OPPO Find X7 Pro',
                'brand' => 'OPPO',
                'featured' => false,
                'status' => 'active',
                'category_id' => $category ? $category->id : 1,
                'brand_id' => 4, // Assuming OPPO brand id
                'model' => 'CPH2491',
                'price' => 25990000,
                'original_price' => 27990000,
                'description' => 'OPPO Find X6 Pro với camera Hasselblad và sạc siêu nhanh',
                'stock_quantity' => 20,
                'color' => 'Desert Silver',
                'storage' => '256GB',
                'condition' => 'new',
                'discount_percentage' => 7.15,
                'warranty_period' => '12 tháng',
                'sku' => 'OFX6P-256-DS',
                'weight' => 218.0,
                'operating_system' => 'Android 13',
                'screen_size' => '6.82 inch',
                'camera' => '50MP Main + 50MP Ultra Wide + 50MP Telephoto',
                'battery' => '5000 mAh',
                'processor' => 'Snapdragon 8 Gen 2',
                'ram' => '12GB',                'image_path' => 'images/Oppo Find X7 crop.png',
                'detail_image_path' => 'images/iPhone 14 detail.png'  // Sử dụng ảnh có sẵn
>>>>>>> Stashed changes
            ]
        ];

        foreach ($phones as $phone) {
            Phone::updateOrCreate(
                ['sku' => $phone['sku']], // Điều kiện tìm kiếm
                $phone // Dữ liệu để tạo hoặc cập nhật
            );
        }
    }
}
