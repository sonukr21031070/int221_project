@extends('layouts.app')

@section('title', $category->name . ' - Accessible Educational Resource Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title">{{ $category->name }}</h1>
                    <p class="card-text">{{ $category->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Categories
                        </a>
                        @auth
                            <div>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Category
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete Category
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <h2 class="mb-4">Resources in this Category</h2>

            <div class="row">
                @forelse($resources as $resource)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $resource->title }}</h5>
                                <p class="card-text text-muted">
                                    <small>
                                        <i class="fas fa-file"></i> {{ ucfirst($resource->file_type) }} |
                                        <i class="fas fa-download"></i> {{ $resource->download_count }} downloads
                                    </small>
                                </p>
                                <p class="card-text">{{ Str::limit($resource->description, 100) }}</p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-universal-access"></i> {{ $resource->metadata->disability_focus }}
                                    </small>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('resources.show', $resource) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                    <a href="{{ route('resources.download', $resource) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No resources found in this category.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $resources->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 