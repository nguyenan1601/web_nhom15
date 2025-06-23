<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_id',
        'image_url',
        'alt_text',
        'is_primary',
        'sort_order',
        'type',
        'color_code',
        'metadata',
    ];
}
