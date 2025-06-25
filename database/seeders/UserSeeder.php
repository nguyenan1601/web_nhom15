<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo một số user mẫu
        $users = [
            [
                'name' => 'Nguyen Van A',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('user123'),
                'phone' => '0900000001',
                'is_admin' => false,
            ],
            [
                'name' => 'Tran Thi B',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('user123'),
                'phone' => '0900000002',
                'is_admin' => false,
            ],
            [
                'name' => 'Le Van C',
                'email' => 'user3@gmail.com',
                'password' => Hash::make('user123'),
                'phone' => '0900000003',
                'is_admin' => false,
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate([
                'email' => $user['email']
            ], $user);
        }
    }
}
