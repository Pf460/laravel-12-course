<?php

namespace App\Providers;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class RateLimiterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        RateLimiter::for('api', function(Request $request) {
            if($request->user()){
                return Limit::perMinute(120)->by($request->user()->id);
            }
            return Limit::perMinute(30)->by($request->ip());
        });
        RateLimiter::for('login', function (Request $request) {
            Limit::perMinute(5)->by($request->ip());
        });
    }
}
