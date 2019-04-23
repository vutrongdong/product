<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UserService', \App\Services\Domain\UserService::class);
        $this->app->bind('SlideService', \App\Services\Domain\SlideService::class);
        $this->app->bind('CategoryService', \App\Services\Domain\CategoryService::class);
        $this->app->bind('BlogService', \App\Services\Domain\BlogService::class);
        $this->app->bind('ProductService', \App\Services\Domain\ProductService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Passport::routes();
    }
}
