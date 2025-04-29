@extends('layouts.app')

@section('title', 'Student Dashboard - Inclusive Learning Hub')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Welcome, {{ Auth::user()->name }}!</h1>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">My Resources</h5>
                            <p class="card-text">Access your downloaded learning materials.</p>
                            <a href="{{ route('resources.index') }}" class="btn btn-primary">
                                <i class="fas fa-book"></i> View Resources
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Categories</h5>
                            <p class="card-text">Browse resources by subject.</p>
                            <a href="{{ route('categories.index') }}" class="btn btn-primary">
                                <i class="fas fa-folder"></i> View Categories
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Accessibility Tools</h5>
                            <p class="card-text">Customize your learning experience.</p>
                            <button class="btn btn-primary" onclick="toggleHighContrast()">
                                <i class="fas fa-adjust"></i> High Contrast
                            </button>
                            <button class="btn btn-primary" onclick="toggleLargeText()">
                                <i class="fas fa-text-height"></i> Large Text
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h2>Recent Resources</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(Auth::user()->resources()->latest()->take(5)->get() as $resource)
                                    <tr>
                                        <td>{{ $resource->title }}</td>
                                        <td>{{ $resource->category->name }}</td>
                                        <td>{{ ucfirst($resource->file_type) }}</td>
                                        <td>
                                            <a href="{{ route('resources.show', $resource) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('resources.download', $resource) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No resources found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 