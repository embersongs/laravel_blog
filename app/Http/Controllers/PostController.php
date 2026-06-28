<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|url',
            'is_published' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['published_at'] = $validated['is_published'] ?? false ? now() : null;

        Post::create($validated);
        return redirect()->route('posts.index')->with('success', 'Пост создан!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|url',
            'is_published' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['published_at'] = $validated['is_published'] ?? false ? now() : null;

        $post->update($validated);
        return redirect()->route('posts.index')->with('success', 'Пост успешно обновлен!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост удален!');
    }
}
