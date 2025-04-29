@extends('layouts.app')

@section('title', $resource->title . ' - Accessible Educational Resource Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ $resource->title }}</h1>
                    <p class="text-muted">
                        <small>
                            Uploaded by {{ $resource->user->name }} | 
                            {{ $resource->created_at->format('F j, Y') }}
                        </small>
                    </p>

                    <div class="mb-4">
                        <h5>Description</h5>
                        <p>{{ $resource->description }}</p>
                    </div>

                    @if($resource->file_type == 'audio' || $resource->file_type == 'video')
                        <div class="mb-4">
                            <h5>Preview</h5>
                            @if($resource->file_type == 'audio')
                                <audio controls class="w-100">
                                    <source src="{{ route('resources.preview', $resource) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @else
                                <video controls class="w-100">
                                    <source src="{{ route('resources.preview', $resource) }}" type="video/mp4">
                                    Your browser does not support the video element.
                                </video>
                            @endif
                        </div>
                    @elseif($resource->file_type == 'pdf')
                        <div class="mb-4">
                            <h5>Preview</h5>
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ route('resources.preview', $resource) }}" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif

                    <div class="d-grid gap-2">
                        <a href="{{ route('resources.download', $resource) }}" class="btn btn-primary">
                            <i class="fas fa-download"></i> Download Resource
                        </a>
                        @can('update', $resource)
                            <a href="{{ route('resources.edit', $resource) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Resource
                            </a>
                        @endcan
                        @can('delete', $resource)
                            <form action="{{ route('resources.destroy', $resource) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash"></i> Delete Resource
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Resource Information</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-folder"></i> Category:
                            <span class="float-end">{{ $resource->category->name }}</span>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-file"></i> Type:
                            <span class="float-end">{{ ucfirst($resource->file_type) }}</span>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-download"></i> Downloads:
                            <span class="float-end">{{ $resource->download_count }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Accessibility Information</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-universal-access"></i> Focus:
                            <span class="float-end">{{ $resource->metadata->disability_focus }}</span>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-language"></i> Language:
                            <span class="float-end">{{ strtoupper($resource->metadata->language) }}</span>
                        </li>
                        @if($resource->metadata->duration_seconds)
                            <li class="mb-2">
                                <i class="fas fa-clock"></i> Duration:
                                <span class="float-end">{{ gmdate('H:i:s', $resource->metadata->duration_seconds) }}</span>
                            </li>
                        @endif
                        @if($resource->metadata->accessibility_features)
                            <li class="mb-2">
                                <i class="fas fa-check-circle"></i> Features:
                                <p class="mt-2">{{ $resource->metadata->accessibility_features }}</p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 