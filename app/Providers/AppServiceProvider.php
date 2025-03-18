<?php

namespace App\Providers;

use App\Http\Repository\BookInterface;
use App\Http\Repository\BookRepository;
use App\Http\Services\BookService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            BookInterface::class,
            BookRepository::class
        );
        $this->app->bind(BookService::class, function ($app) {
            return new BookService($app->make(BookInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
