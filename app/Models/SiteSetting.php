<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_logo_path',
        'intro_image_path',
        'ad1_path',
        'ad2_path',
        'ad3_path',
        'ad4_path',
        'hero_slider_images',
        'navbar_logo_path',
    ];

    protected $casts = [
        'hero_slider_images' => 'array',
    ];
}
