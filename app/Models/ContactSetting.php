<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'organization_name',
        'registration_no',
        'phones',
        'emails',
        'location',
    ];

    protected $casts = [
        'phones' => 'array',
        'emails' => 'array',
    ];
}
