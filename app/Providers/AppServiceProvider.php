<?php

namespace App\Providers;


use App\Repositories\PostRepository;
use Illuminate\Pagination\Paginator;
use App\Repositories\AdminRepository;
use App\Repositories\EditorRepository;
use Illuminate\Support\ServiceProvider;
use App\RepositoryInterface\PostRepositoryInterface;
use App\RepositoryInterface\AdminRepositoryInterface;
use App\RepositoryInterface\EditorRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(EditorRepositoryInterface::class, EditorRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // Paginator::useBootstrapFive();

    }
}
