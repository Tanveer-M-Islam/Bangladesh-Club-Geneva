<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutBcgSetting extends Model
{
    /** @use HasFactory<\Database\Factories\AboutBcgSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'president_name',
        'president_image_path',
        'president_speech',
        'gs_name',
        'gs_image_path',
        'gs_speech',
        'mission_title',
        'mission_image_path',
        'mission_text',
        'vision_title',
        'vision_image_path',
        'vision_text',
        'terms_title',
        'terms_image_path',
        'terms_text',
        'executive_members',
        'general_members',
        'other_speeches',
    ];

    protected $casts = [
        'executive_members' => 'array',
        'general_members' => 'array',
        'other_speeches' => 'array',
    ];
}
