@extends('layouts.app')

@section('title', 'Все посты')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Все посты</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Создать пост
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            @forelse($posts as $post)
                <div class="card mb-3">
                    @if($post->image)
                        <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->title }}" style="max-height: 300px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                                {{ $post->title }}
                            </a>
                            @if(!$post->is_published)
                                <span class="badge bg-warning text-dark">Черновик</span>
                            @endif
                        </h5>
                        <p class="card-text">{{ Str::limit($post->content, 200) }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                            <span class="badge bg-primary">
                                <i class="fas fa-folder"></i> {{ $post->category->name }}
                            </span>
                                <small class="text-muted ms-2">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $post->created_at->format('d.m.Y H:i') }}
                                </small>
                            </div>
                            <div>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить пост?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Постов пока нет.</p>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Создать первый пост</a>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
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
        </div>
    </div>
@endsection
