<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Phone;
use App\Models\PhoneImage;

class PhoneImageSeeder extends Seeder
{
    public function run(): void
    {
        $phones = Phone::all();
        foreach ($phones as $phone) {
            if ($phone->image_path) {
                PhoneImage::create([
                    'phone_id' => $phone->id,
                    'image_url' => $phone->image_path,
                    'alt_text' => $phone->name,
                    'is_primary' => true,
                    'sort_order' => 1,
                    'type' => 'main',
                ]);
            }
        }
    }
}
