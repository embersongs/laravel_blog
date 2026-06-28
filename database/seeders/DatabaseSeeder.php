<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем категории
        $categories = [
            ['name' => 'Технологии', 'slug' => 'technology', 'description' => 'Статьи о технологиях'],
            ['name' => 'Путешествия', 'slug' => 'travel', 'description' => 'Путевые заметки'],
            ['name' => 'Еда', 'slug' => 'food', 'description' => 'Рецепты и обзоры'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Создаем посты
        $category = Category::first();
        Post::create([
            'category_id' => $category->id,
            'title' => 'Первый пост',
            'slug' => 'first-post',
            'content' => 'Содержание первого поста...',
            'is_published' => true,
            'published_at' => now()
        ]);
    }
}
