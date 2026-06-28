<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'image',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Связь с категорией
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope для опубликованных постов
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope для последних постов
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
