<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Books;
use App\Observers\BookObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Books::observe(BookObserver::class);
    }
}
