<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chạy seeders theo thứ tự để tránh lỗi foreign key
        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            PhoneSeeder::class,
        ]);
        
        $this->command->info('🎉 Database seeding completed successfully!');
        $this->command->info('📱 Created brands, categories and phones data');
        $this->command->info('🔍 You can check data at: http://localhost/phpmyadmin');
    }
}