<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'footer_info',
        'copyright_text',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
    ];
}
