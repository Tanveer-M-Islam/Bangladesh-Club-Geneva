<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'event_date',
        'images',
        'is_featured',
    ];

    protected $casts = [
        'images' => 'array',
        'event_date' => 'date',
        'is_featured' => 'boolean',
    ];
}
