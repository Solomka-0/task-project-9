<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Interfaces\SettingConfirmationRepositoryInterface::class,
            \App\Repositories\SettingConfirmationRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\UserSettingRepositoryInterface::class,
            \App\Repositories\UserSettingRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
