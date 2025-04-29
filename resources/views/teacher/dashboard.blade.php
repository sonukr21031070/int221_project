@extends('layouts.app')

@section('title', 'Teacher Dashboard - Inclusive Learning Hub')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Teacher Dashboard</h1>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Upload Resources</h5>
                            <p class="card-text">Share educational materials with students.</p>
                            <a href="{{ route('resources.create') }}" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Resource
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">My Resources</h5>
                            <p class="card-text">Manage your uploaded resources.</p>
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
                            <p class="card-text">Browse resource categories.</p>
                            <a href="{{ route('categories.index') }}" class="btn btn-primary">
                                <i class="fas fa-folder"></i> View Categories
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h2>Recent Uploads</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Downloads</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(Auth::user()->resources()->latest()->take(5)->get() as $resource)
                                    <tr>
                                        <td>{{ $resource->title }}</td>
                                        <td>{{ $resource->category->name }}</td>
                                        <td>{{ ucfirst($resource->file_type) }}</td>
                                        <td>{{ $resource->download_count }}</td>
                                        <td>
                                            <a href="{{ route('resources.show', $resource) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('resources.edit', $resource) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No resources uploaded yet</td>
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