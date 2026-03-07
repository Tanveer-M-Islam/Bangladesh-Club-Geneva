<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'hero_title',
        'introduction',
        'hero_logo_path',
        'intro_image_path',
        'ad1_path',
        'ad2_path',
        'ad3_path',
        'ad4_path',
        'ad5_path',
        'ad6_path',
        'ad7_path',
        'ad8_path',
        'hero_slider_images',
        'navbar_logo_path',
    ];

    protected $casts = [
        'hero_slider_images' => 'array',
    ];
}
