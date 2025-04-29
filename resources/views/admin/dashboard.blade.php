@extends('layouts.app')

@section('title', 'Admin Dashboard - Inclusive Learning Hub')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Admin Dashboard</h1>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Categories</h5>
                            <p class="card-text">Create and manage resource categories.</p>
                            <a href="{{ route('categories.index') }}" class="btn btn-primary">
                                <i class="fas fa-folder"></i> View Categories
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Users</h5>
                            <p class="card-text">View and manage user accounts.</p>
                            <a href="{{ route('admin.users') }}" class="btn btn-primary">
                                <i class="fas fa-users"></i> View Users
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">System Overview</h5>
                            <p class="card-text">View system statistics and status.</p>
                            <button class="btn btn-primary" disabled>
                                <i class="fas fa-chart-bar"></i> View Statistics
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h2>Recent Activities</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-center">No recent activities</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 