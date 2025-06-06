<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phone;
use Illuminate\Support\Str;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phones = [
            // iPhone Models
            [
                'name' => 'iPhone 15 Pro Max',
                'brand' => 'Apple',
                'featured' => true,
                'status' => 'active',
                'category_id' => 1, // Smartphone Cao Cấp
                'brand_id' => 1, // Apple
                'model' => 'A3108',
                'price' => 34990000,
                'original_price' => 36990000,
                'description' => 'iPhone 15 Pro Max với chip A17 Pro, camera 48MP cực đỉnh và thân máy titan',
                'specifications' => json_encode([
                    'screen' => '6.7" Super Retina XDR OLED',
                    'resolution' => '2796 x 1290 pixels',
                    'chip' => 'Apple A17 Pro 6-core',
                    'rear_camera' => '48MP + 12MP + 12MP',
                    'front_camera' => '12MP TrueDepth',
                    'battery' => '4441 mAh',
                    'charging' => '27W Lightning + 15W MagSafe Wireless',
                    'sim' => 'Nano SIM + eSIM',
                    'os' => 'iOS 17'
                ]),
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
                'processor' => 'Apple A17 Pro',
                'ram' => '8GB',
                'is_available' => true,
                'view_count' => 1250,
                'released_at' => '2023-09-22'
            ],
            [
                'name' => 'iPhone 14',
                'brand' => 'Apple',
                'featured' => true,
                'status' => 'active',
                'category_id' => 1,
                'brand_id' => 1,
                'model' => 'A2882',
                'price' => 22990000,
                'original_price' => 24990000,
                'description' => 'iPhone 14 với camera kép 12MP, chip A15 Bionic mạnh mẽ',
                'specifications' => json_encode([
                    'screen' => '6.1" Super Retina XDR OLED',
                    'resolution' => '2556 x 1179 pixels',
                    'chip' => 'Apple A15 Bionic 6-core',
                    'rear_camera' => '12MP + 12MP',
                    'front_camera' => '12MP TrueDepth',
                    'battery' => '3279 mAh',
                    'charging' => '20W Lightning + 15W MagSafe Wireless',
                    'sim' => 'Nano SIM + eSIM',
                    'os' => 'iOS 16'
                ]),
                'stock_quantity' => 75,
                'color' => 'Midnight',
                'storage' => '128GB',
                'condition' => 'new',
                'discount_percentage' => 8.0,
                'warranty_period' => '12 tháng',
                'sku' => 'IP14-128-MD',
                'weight' => 172.0,
                'operating_system' => 'iOS 16',
                'screen_size' => '6.1 inch',
                'camera' => '12MP Main + 12MP Ultra Wide',
                'battery' => '3279 mAh',
                'processor' => 'Apple A15 Bionic',
                'ram' => '6GB',
                'is_available' => true,
                'view_count' => 890,
                'released_at' => '2022-09-16'
            ],
            // Samsung Galaxy Models
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'brand' => 'Samsung',
                'featured' => true,
                'status' => 'active',
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
                'storage' => '256GB',
                'condition' => 'new',
                'discount_percentage' => 5.56,
                'warranty_period' => '12 tháng',
                'sku' => 'SS24U-256-TB',
                'weight' => 232.0,
                'operating_system' => 'Android 14',
                'screen_size' => '6.8 inch',
                'camera' => '200MP Main + 50MP Periscope + 12MP Ultra Wide + 10MP Telephoto',
                'battery' => '5000 mAh',
                'processor' => 'Snapdragon 8 Gen 3',
                'ram' => '12GB',
                'is_available' => true,
                'view_count' => 1100,
                'released_at' => '2024-01-24'
            ],
            [
                'name' => 'Samsung Galaxy A55',
                'brand' => 'Samsung',
                'featured' => false,
                'status' => 'active',
                'category_id' => 2, // Smartphone Tầm Trung
                'brand_id' => 2,
                'model' => 'SM-A556B',
                'price' => 10490000,
                'original_price' => 11990000,
                'description' => 'Galaxy A55 với camera 50MP OIS và chip Exynos 1480 mạnh mẽ',
                'specifications' => json_encode([
                    'screen' => '6.6" Super AMOLED',
                    'resolution' => '2340 x 1080 pixels',
                    'chip' => 'Exynos 1480 8-core',
                    'rear_camera' => '50MP + 12MP + 5MP',
                    'front_camera' => '32MP',
                    'battery' => '5000 mAh',
                    'charging' => '25W Type-C',
                    'sim' => 'Nano SIM + eSIM',
                    'os' => 'Android 14, One UI 6.1'
                ]),
                'stock_quantity' => 120,
                'color' => 'Awesome Navy',
                'storage' => '128GB',
                'condition' => 'new',
                'discount_percentage' => 12.51,
                'warranty_period' => '12 tháng',
                'sku' => 'SSA55-128-AN',
                'weight' => 213.0,
                'operating_system' => 'Android 14',
                'screen_size' => '6.6 inch',
                'camera' => '50MP Main + 12MP Ultra Wide + 5MP Macro',
                'battery' => '5000 mAh',
                'processor' => 'Exynos 1480',
                'ram' => '8GB',
                'is_available' => true,
                'view_count' => 450,
                'released_at' => '2024-03-11'
            ],
            // Xiaomi Models
            [
                'name' => 'Xiaomi 14 Ultra',
                'brand' => 'Xiaomi',
                'featured' => true,
                'status' => 'active',
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
                'color' => 'Black',
                'storage' => '512GB',
                'condition' => 'new',
                'discount_percentage' => 6.25,
                'warranty_period' => '18 tháng',
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
                'operating_system' => 'Android 13',
                'screen_size' => '6.67 inch',
                'camera' => '108MP Main + 8MP Ultra Wide + 2MP Macro',
                'battery' => '5000 mAh',
                'processor' => 'Snapdragon 685',
                'ram' => '6GB',
                'is_available' => true,
                'view_count' => 750,
                'released_at' => '2024-01-15'
            ]
        ];

        foreach ($phones as $phone) {
            Phone::create($phone);
        }
    }
}
