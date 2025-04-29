@extends('layouts.app')

@section('title', 'Welcome - Inclusive Learning Hub')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4 mb-4">Welcome to the Inclusive Learning Hub</h1>
            <p class="lead mb-4">
                A dedicated platform for specially abled students to access educational resources
                tailored to their unique learning needs and abilities.
            </p>

            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-universal-access fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Accessible Learning</h5>
                            <p class="card-text">Resources designed with accessibility in mind, including screen reader compatibility and alternative formats.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-hands-helping fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Personalized Support</h5>
                            <p class="card-text">Learning materials adapted to different abilities and learning styles.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Inclusive Community</h5>
                            <p class="card-text">Connect with educators and peers who understand your learning journey.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="{{ route('resources.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-search"></i> Explore Resources
                </a>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                @endguest
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Learning Categories</h2>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <p class="card-text">{{ Str::limit($category->description, 100) }}</p>
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-right"></i> View Resources
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mt-5" id="accessibility-tools">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Accessibility Features</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-adjust fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">High Contrast Mode</h5>
                            <p class="card-text">Enhanced visibility for visually impaired users.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-text-height fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Text Size Adjustment</h5>
                            <p class="card-text">Customize text size for better readability.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-volume-up fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Screen Reader Support</h5>
                            <p class="card-text">Compatible with popular screen readers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-keyboard fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Keyboard Navigation</h5>
                            <p class="card-text">Full keyboard accessibility support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
