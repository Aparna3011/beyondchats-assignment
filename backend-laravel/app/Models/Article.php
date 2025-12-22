<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'version',
        'references',
        'source_url',
        'published_at',
    ];

    protected $casts = [
        'references' => 'array',
        'published_at' => 'datetime',
    ];
}
