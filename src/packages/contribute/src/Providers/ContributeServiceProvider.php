<?php

namespace GGPHP\Contribute\Providers;

use GGPHP\Contribute\Repositories\Contracts\ContributeRepository;
use GGPHP\Contribute\Repositories\Eloquent\ContributeRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class ContributeServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'view-contribute');

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContributeRepository::class, ContributeRepositoryEloquent::class);
    }
}
