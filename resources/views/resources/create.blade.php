@extends('layouts.app')

@section('title', 'Upload Resource - Accessible Educational Resource Library')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload Educational Resource</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Resource File</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required>
                            <small class="text-muted">Max file size: 100MB. Supported formats: PDF, Audio (MP3, WAV), Video (MP4), Text documents</small>
                            @error('file')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="disability_focus" class="form-label">Accessibility Focus</label>
                            <select class="form-select @error('disability_focus') is-invalid @enderror" id="disability_focus" name="disability_focus" required>
                                <option value="">Select accessibility focus</option>
                                <option value="hearing-impaired" {{ old('disability_focus') == 'hearing-impaired' ? 'selected' : '' }}>Hearing Impaired</option>
                                <option value="visually-impaired" {{ old('disability_focus') == 'visually-impaired' ? 'selected' : '' }}>Visually Impaired</option>
                                <option value="learning-disability" {{ old('disability_focus') == 'learning-disability' ? 'selected' : '' }}>Learning Disability</option>
                                <option value="physical-disability" {{ old('disability_focus') == 'physical-disability' ? 'selected' : '' }}>Physical Disability</option>
                            </select>
                            @error('disability_focus')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="accessibility_features" class="form-label">Accessibility Features</label>
                            <textarea class="form-control @error('accessibility_features') is-invalid @enderror" id="accessibility_features" name="accessibility_features" rows="2">{{ old('accessibility_features') }}</textarea>
                            <small class="text-muted">Describe any specific accessibility features (e.g., closed captions, screen reader compatibility)</small>
                            @error('accessibility_features')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="language" class="form-label">Language</label>
                            <select class="form-select @error('language') is-invalid @enderror" id="language" name="language" required>
                                <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="es" {{ old('language') == 'es' ? 'selected' : '' }}>Spanish</option>
                                <option value="fr" {{ old('language') == 'fr' ? 'selected' : '' }}>French</option>
                                <!-- Add more languages as needed -->
                            </select>
                            @error('language')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration_seconds" class="form-label">Duration (in seconds)</label>
                            <input type="number" class="form-control @error('duration_seconds') is-invalid @enderror" id="duration_seconds" name="duration_seconds" value="{{ old('duration_seconds') }}">
                            <small class="text-muted">For audio/video content only</small>
                            @error('duration_seconds')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Resource
                            </button>
                            <a href="{{ route('resources.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Resources
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 