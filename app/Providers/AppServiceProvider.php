<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\UpdateUserPassword;

class AppServiceProvider extends ServiceProvider
{
     public const HOME = '/';
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
        // Register custom password update action for Fortify
        if (class_exists(Fortify::class)) {
            Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        }
    }
}
