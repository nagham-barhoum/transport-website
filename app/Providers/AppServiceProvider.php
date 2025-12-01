<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Referer\Referer;
use Illuminate\Session\Store as SessionStore;
use Illuminate\Http\Request;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Referer::class, function ($app) {
            return new Referer(
                'referer', // Array of sources
                config('referer.sources'), // Sources (array)
                $app->make(SessionStore::class), // Laravel session
                $app->make(Request::class) /// Laravel request
            );
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
