<?php

namespace Monet\Framework\Auth;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/auth.php', 'monet.auth'
        );

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'monet.auth');

        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../config/auth.php' => config_path('monet-auth.php')
        ]);

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/monet/auth')
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}