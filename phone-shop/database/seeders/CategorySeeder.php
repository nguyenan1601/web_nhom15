<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Smartphone Cao Cấp',
                'description' => 'Các dòng điện thoại flagship với công nghệ tiên tiến nhất'
            ],
            [
                'name' => 'Smartphone Tầm Trung',
                'description' => 'Điện thoại có hiệu năng tốt với mức giá hợp lý'
            ],
            [
                'name' => 'Smartphone Giá Rẻ',
                'description' => 'Điện thoại phù hợp với ngân sách tiết kiệm'
            ],
            [
                'name' => 'iPhone',
                'description' => 'Dòng sản phẩm iPhone của Apple'
            ],
            [
                'name' => 'Samsung Galaxy',
                'description' => 'Dòng sản phẩm Galaxy của Samsung'
            ],
            [
                'name' => 'Gaming Phone',
                'description' => 'Điện thoại chuyên dụng cho gaming'
            ],
            [
                'name' => 'Điện Thoại Nắp Gập',
                'description' => 'Điện thoại màn hình gập hiện đại'
            ],
            [
                'name' => 'Điện Thoại Camera Chuyên Nghiệp',
                'description' => 'Điện thoại tập trung vào khả năng chụp ảnh'
            ]
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']], // Điều kiện tìm kiếm
                $category // Dữ liệu để tạo hoặc cập nhật
            );
        }
    }
}
