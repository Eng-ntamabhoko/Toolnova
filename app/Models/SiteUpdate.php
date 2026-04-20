<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'update_type',
        'link',
        'is_published',
        'is_featured_on_home',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured_on_home' => 'boolean',
        'published_at' => 'datetime',
    ];
}
