<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories|max:255',
            'description' => 'nullable'
        ]);

        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Категория создана!');
    }

    public function show(Category $category)
    {
        $posts = $category->posts()->published()->latest()->paginate(10);
        return view('categories.show', compact('category', 'posts'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories,slug,' . $category->id,
            'description' => 'nullable'
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Категория обновлена!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Категория удалена!');
    }
}
