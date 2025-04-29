<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Resource;
use App\Policies\CategoryPolicy;
use App\Policies\ResourcePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Resource::class => ResourcePolicy::class,
        Category::class => CategoryPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
} 