<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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
        // Sanctum can get Access to the cookie instaed of pasing token as header from js.
        // The token can have HttpOnly Flag 
        // If you want to remove this option, you have to disable HttpOnly Flag from auth-token cookie and pass it from js in headers.
        Sanctum::getAccessTokenFromRequestUsing(function($request) {
            return $request->cookie('auth-token');
        });
    }
}
