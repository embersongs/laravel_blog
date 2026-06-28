@extends('layouts.app')

@section('title', 'Редактировать пост - ' . $post->title)

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0">Редактировать пост</h1>
                    <small class="text-muted">{{ $post->title }}</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Поле: Заголовок --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Заголовок <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $post->title) }}"
                                placeholder="Введите заголовок поста"
                            >
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Поле: Категория --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Категория <span class="text-danger">*</span></label>
                            <select
                                name="category_id"
                                id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror"
                            >
                                <option value="">Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Поле: Содержание --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">Содержание <span class="text-danger">*</span></label>
                            <textarea
                                name="content"
                                id="content"
                                class="form-control @error('content') is-invalid @enderror"
                                rows="8"
                                placeholder="Введите содержание поста"
                            >{{ old('content', $post->content) }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Поле: Изображение --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение (URL)</label>
                            <input
                                type="url"
                                name="image"
                                id="image"
                                class="form-control @error('image') is-invalid @enderror"
                                value="{{ old('image', $post->image) }}"
                                placeholder="https://example.com/image.jpg"
                            >
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($post->image)
                                <div class="form-text">
                                    Текущее изображение: <a href="{{ $post->image }}" target="_blank">{{ $post->image }}</a>
                                </div>
                            @endif
                        </div>

                        {{-- Поле: Опубликовать --}}
                        <div class="mb-3 form-check">
                            <input
                                type="checkbox"
                                name="is_published"
                                id="is_published"
                                class="form-check-input @error('is_published') is-invalid @enderror"
                                value="1"
                                {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="is_published">Опубликовано</label>
                            @error('is_published')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check2-circle"></i> Обновить
                            </button>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
