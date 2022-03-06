<?php

namespace Monet\Framework\Auth;

use Monet\Framework\Support\Services\Package;
use Monet\Framework\Support\Services\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('monet.auth')
            ->hasConfig()
            ->hasRoute('web')
            ->hasViews()
            ->hasMigrations([
                'create_users_table',
                'create_password_resets_table'
            ]);
    }
}