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
                'status' => 'active',
                'sort_order' => 1
            ],
            [
                'name' => 'Smartphone Tầm Trung',
                'status' => 'active',
                'sort_order' => 2
            ],
            [
                'name' => 'Smartphone Giá Rẻ',
                'status' => 'active',
                'sort_order' => 3
            ],
            [
                'name' => 'iPhone',
                'status' => 'active',
                'sort_order' => 4
            ],
            [
                'name' => 'Samsung Galaxy',
                'status' => 'active',
                'sort_order' => 5
            ],
            [
                'name' => 'Gaming Phone',
                'status' => 'active',
                'sort_order' => 6
            ],
            [
                'name' => 'Điện Thoại Nắp Gập',
                'status' => 'active',
                'sort_order' => 7
            ],
            [
                'name' => 'Điện Thoại Camera Chuyên Nghiệp',
                'status' => 'active',
                'sort_order' => 8
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
