<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\CategoryController;

// Public routes
Route::get('/', function () {
    $categories = \App\Models\Category::all();
    return view('welcome', compact('categories'));
});

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'student') {
            return view('dashboard');
        }
        return redirect()->route('login');
    })->name('dashboard');
    
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
    Route::get('/resources/{resource}', [ResourceController::class, 'show'])->name('resources.show');
    Route::get('/resources/{resource}/download', [ResourceController::class, 'download'])->name('resources.download');
});

// Teacher Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/teacher/dashboard', function () {
        if (auth()->user()->role === 'teacher') {
            return view('teacher.dashboard');
        }
        return redirect()->route('login');
    })->name('teacher.dashboard');
    
    Route::resource('resources', ResourceController::class)->except(['index', 'show', 'download']);
    Route::get('/resources/{resource}/preview', [ResourceController::class, 'preview'])->name('resources.preview');
});

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return view('admin.dashboard');
        }
        return redirect()->route('login');
    })->name('admin.dashboard');
    
    Route::resource('categories', CategoryController::class);
    Route::get('/admin/users', [AuthController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/{user}', [AuthController::class, 'show'])->name('admin.users.show');
    Route::put('/admin/users/{user}', [AuthController::class, 'update'])->name('admin.users.update');
});
