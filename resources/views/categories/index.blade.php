@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Категории</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Создать категорию
        </a>
    </div>

    <div class="row">
        @forelse($categories as $category)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-folder text-primary"></i> {{ $category->name }}
                        </h5>
                        @if($category->description)
                            <p class="card-text text-muted">{{ $category->description }}</p>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-secondary">
                            <i class="fas fa-newspaper"></i> {{ $category->posts_count }} постов
                        </span>
                            <div>
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить категорию?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Категорий пока нет.</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Создать первую категорию</a>
                </div>
            </div>
        @endforelse
    </div>
@endsection
