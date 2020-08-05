<?php

namespace GGPHP\Request\Providers;

use GGPHP\Request\Repositories\Contracts\RequestRepository;
use GGPHP\Request\Repositories\Eloquent\RequestRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RequestRepository::class, RequestRepositoryEloquent::class);
    }
}
