@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-muted">{{ $category->description }}</p>
            @endif
            <span class="badge bg-secondary">
            <i class="fas fa-newspaper"></i> Всего постов: {{ $posts->total() }}
        </span>
        </div>
        <div>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Редактировать
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            @forelse($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                                {{ $post->title }}
                            </a>
                            @if(!$post->is_published)
                                <span class="badge bg-warning text-dark">Черновик</span>
                            @endif
                        </h5>
                        <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="far fa-calendar-alt"></i>
                                {{ $post->created_at->format('d.m.Y') }}
                            </small>
                            <div>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <p class="text-muted">В этой категории пока нет постов.</p>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Создать пост</a>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
