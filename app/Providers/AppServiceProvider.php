<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        $this->registerMiddleware();
    }
    
    protected function registerMiddleware()
    {
        Route::aliasMiddleware('checkrole', \App\Http\Middleware\CheckRole::class);
        Route::aliasMiddleware('authprofex', \App\Http\Middleware\AuthProfedex::class);
    }
}
