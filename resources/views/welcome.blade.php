@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-4">Последние посты</h1>

            @php
                $posts = App\Models\Post::with('category')->published()->latest()->limit(5)->get();
            @endphp

            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <p class="card-text">{{ Str::limit($post->content, 200) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">{{ $post->category->name }}</span>
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $post->created_at->format('d.m.Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">Все посты →</a>
            @else
                <p class="text-muted">Постов пока нет.</p>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-tags"></i> Категории
                </div>
                <div class="card-body">
                    @php
                        $categories = App\Models\Category::withCount('posts')->get();
                    @endphp
                    @foreach($categories as $category)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <a href="{{ route('categories.show', $category) }}" class="text-decoration-none">
                                {{ $category->name }}
                            </a>
                            <span class="badge bg-secondary">{{ $category->posts_count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-info-circle"></i> О блоге
                </div>
                <div class="card-body">
                    <p class="card-text">Простой блог на Laravel с постами и категориями.</p>
                    <p class="card-text">
                        <small class="text-muted">
                            Всего постов: {{ App\Models\Post::count() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
