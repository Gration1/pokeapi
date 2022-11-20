<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Business Services
        $this->app->bind(\App\Services\Pokemon\PokemonServiceInterface::class, \App\Services\Pokemon\PokemonService::class);

        // Repositories
        $this->app->bind(\App\Repositories\Pokemon\PokemonRepositoryInterface::class, \App\Repositories\Pokemon\PokemonRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
