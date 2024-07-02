<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\userRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(userRepository::class, function ($app) {
            return new userRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
