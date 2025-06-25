<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Apple',
                'slug' => 'apple',
                'description' => 'Apple Inc. là một tập đoàn công nghệ đa quốc gia của Mỹ có trụ sở tại Cupertino, California.',
                'logo' => 'brands/apple-logo.png',
                'country' => 'United States',
                'website' => 'https://www.apple.com',
                'status' => 'active',
                'sort_order' => 1,
                'is_featured' => true,
                'meta_data' => json_encode(['founded' => 1976, 'color' => '#000000'])
            ],
            [
                'name' => 'Samsung',
                'slug' => 'samsung',
                'description' => 'Samsung Electronics là một trong những công ty điện tử lớn nhất thế giới, có trụ sở tại Hàn Quốc.',
                'logo' => 'brands/samsung-logo.png',
                'country' => 'South Korea',
                'website' => 'https://www.samsung.com',
                'status' => 'active',
                'sort_order' => 2,
                'is_featured' => true,
                'meta_data' => json_encode(['founded' => 1969, 'color' => '#1428A0'])
            ],
            [
                'name' => 'Xiaomi',
                'slug' => 'xiaomi',
                'description' => 'Xiaomi Corporation là một công ty điện tử đa quốc gia của Trung Quốc, chuyên về smartphone và các thiết bị thông minh.',
                'logo' => 'brands/xiaomi-logo.png',
                'country' => 'China',
                'website' => 'https://www.mi.com',
                'status' => 'active',
                'sort_order' => 3,
                'is_featured' => true,
                'meta_data' => json_encode(['founded' => 2010, 'color' => '#FF6900'])
            ],
            [
                'name' => 'Oppo',
                'slug' => 'oppo',
                'description' => 'OPPO là một thương hiệu smartphone cao cấp của Trung Quốc, nổi tiếng với camera selfie và thiết kế đẹp.',
                'logo' => 'brands/oppo-logo.png',
                'country' => 'China',
                'website' => 'https://www.oppo.com',
                'status' => 'active',
                'sort_order' => 4,
                'is_featured' => true,
                'meta_data' => json_encode(['founded' => 2004, 'color' => '#1BA784'])
            ],
            [
                'name' => 'Vivo',
                'slug' => 'vivo',
                'description' => 'Vivo là một thương hiệu smartphone của Trung Quốc, tập trung vào camera và âm thanh chất lượng cao.',
                'logo' => 'brands/vivo-logo.png',
                'country' => 'China',
                'website' => 'https://www.vivo.com',
                'status' => 'active',
                'sort_order' => 5,
                'is_featured' => false,
                'meta_data' => json_encode(['founded' => 2009, 'color' => '#5B7DC7'])
            ],
            [
                'name' => 'Realme',
                'slug' => 'realme',
                'description' => 'Realme là thương hiệu smartphone trẻ trung, cung cấp công nghệ tiên tiến với giá cả hợp lý.',
                'logo' => 'brands/realme-logo.png',
                'country' => 'China',
                'website' => 'https://www.realme.com',
                'status' => 'active',
                'sort_order' => 6,
                'is_featured' => false,
                'meta_data' => json_encode(['founded' => 2018, 'color' => '#F4C20D'])
            ],
            [
                'name' => 'Nokia',
                'slug' => 'nokia',
                'description' => 'Nokia là một thương hiệu điện thoại lâu đời từ Phần Lan, nổi tiếng với độ bền và pin lâu.',
                'logo' => 'brands/nokia-logo.png',
                'country' => 'Finland',
                'website' => 'https://www.nokia.com',
                'status' => 'active',
                'sort_order' => 7,
                'is_featured' => false,
                'meta_data' => json_encode(['founded' => 1865, 'color' => '#124191'])
            ],
            [
                'name' => 'Huawei',
                'slug' => 'huawei',
                'description' => 'Huawei là một công ty công nghệ đa quốc gia của Trung Quốc, chuyên về thiết bị viễn thông và smartphone.',
                'logo' => 'brands/huawei-logo.png',
                'country' => 'China',
                'website' => 'https://www.huawei.com',
                'status' => 'active',
                'sort_order' => 8,
                'is_featured' => false,
                'meta_data' => json_encode(['founded' => 1987, 'color' => '#FF0000'])
            ]
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
            ['name' => $brand['name']],
            $brand
    );
}
    }
}
