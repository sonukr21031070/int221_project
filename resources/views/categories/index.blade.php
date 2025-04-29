@extends('layouts.app')

@section('title', 'Categories - Accessible Educational Resource Library')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Categories</h1>
        @auth
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Category
            </a>
        @endauth
    </div>

    <div class="row">
        @forelse($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-book"></i> {{ $category->resources_count }} resources
                            </small>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View Resources
                            </a>
                            @auth
                                <div>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No categories found. Create one to get started!
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection 