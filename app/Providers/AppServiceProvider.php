<?php

namespace App\Providers;




use Illuminate\Support\Facades\App;
use App\Repositories\AuthRepository;
use App\Repositories\PostRepository;
use Illuminate\Pagination\Paginator;
use App\Repositories\AdminRepository;
use App\Repositories\EditorRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EditorPostRepository;
use App\Repositories\StripePaymentRepository;
use App\RepositoryInterface\AuthRepositoryInterface;
use App\RepositoryInterface\PostRepositoryInterface;
use App\RepositoryInterface\AdminRepositoryInterface;
use App\RepositoryInterface\EditorRepositoryInterface;
use App\RepositoryInterface\PaymentRepositoryInterface;
use App\RepositoryInterface\EditorPostRepositoryInterface;

use Illuminate\Support\Facades\Session;

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
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, StripePaymentRepository::class);
        $this->app->bind(EditorPostRepositoryInterface::class, EditorPostRepository::class);



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
       App::setLocale(session::get('lang', config('app.locale')));

    }
}
