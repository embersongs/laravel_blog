<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    // Связь с постами
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Активные посты
    public function publishedPosts()
    {
        return $this->hasMany(Post::class)->where('is_published', true);
    }
}
