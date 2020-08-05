<?php

namespace GGPHP\Necessary\Providers;

use GGPHP\Necessary\Repositories\Contracts\NecessaryRepository;
use GGPHP\Necessary\Repositories\Eloquent\NecessaryRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class NecessaryServiceProvider extends ServiceProvider
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
        $this->app->bind(NecessaryRepository::class, NecessaryRepositoryEloquent::class);
    }
}
