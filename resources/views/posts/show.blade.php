@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Посты</a></li>
                    <li class="breadcrumb-item active">{{ $post->title }}</li>
                </ol>
            </nav>

            <div class="card">
                @if($post->image)
                    <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->title }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $post->title }}</h1>

                    <div class="mb-3">
                    <span class="badge bg-primary">
                        <i class="fas fa-folder"></i> {{ $post->category->name }}
                    </span>
                        <span class="badge bg-secondary">
                        <i class="far fa-calendar-alt"></i>
                        {{ $post->created_at->format('d.m.Y H:i') }}
                    </span>
                        @if($post->is_published)
                            <span class="badge bg-success">Опубликован</span>
                        @else
                            <span class="badge bg-warning text-dark">Черновик</span>
                        @endif
                    </div>

                    <div class="post-content">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Назад
                        </a>
                        <div>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Редактировать
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить пост?')">
                                    <i class="fas fa-trash"></i> Удалить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-info-circle"></i> Информация
                </div>
                <div class="card-body">
                    <p><strong>Категория:</strong> {{ $post->category->name }}</p>
                    <p><strong>Создан:</strong> {{ $post->created_at->format('d.m.Y H:i') }}</p>
                    @if($post->updated_at != $post->created_at)
                        <p><strong>Обновлен:</strong> {{ $post->updated_at->format('d.m.Y H:i') }}</p>
                    @endif
                    <p><strong>Статус:</strong>
                        @if($post->is_published)
                            <span class="badge bg-success">Опубликован</span>
                        @else
                            <span class="badge bg-warning text-dark">Черновик</span>
                        @endif
                    </p>
                    @if($post->published_at)
                        <p><strong>Опубликован:</strong> {{ $post->published_at->format('d.m.Y H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .post-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }
    </style>
@endpush
