@extends('layouts.app')

@section('title', 'Resources - Accessible Educational Resource Library')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Educational Resources</h1>
        @auth
            <a href="{{ route('resources.create') }}" class="btn btn-primary">
                <i class="fas fa-upload"></i> Upload Resource
            </a>
        @endauth
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('resources.index') }}" method="GET">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Resource Type</label>
                            <select name="type" id="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                                <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                                <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                <option value="text" {{ request('type') == 'text' ? 'selected' : '' }}>Text</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="disability_focus" class="form-label">Accessibility Focus</label>
                            <select name="disability_focus" id="disability_focus" class="form-select">
                                <option value="">All</option>
                                <option value="hearing-impaired" {{ request('disability_focus') == 'hearing-impaired' ? 'selected' : '' }}>Hearing Impaired</option>
                                <option value="visually-impaired" {{ request('disability_focus') == 'visually-impaired' ? 'selected' : '' }}>Visually Impaired</option>
                                <option value="learning-disability" {{ request('disability_focus') == 'learning-disability' ? 'selected' : '' }}>Learning Disability</option>
                                <option value="physical-disability" {{ request('disability_focus') == 'physical-disability' ? 'selected' : '' }}>Physical Disability</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                @forelse($resources as $resource)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $resource->title }}</h5>
                                <p class="card-text text-muted">
                                    <small>
                                        <i class="fas fa-folder"></i> {{ $resource->category->name }} |
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
                            No resources found matching your criteria.
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