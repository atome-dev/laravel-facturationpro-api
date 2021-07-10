<?php

namespace AtomeDev\FacturationProApi;

use Illuminate\Support\ServiceProvider;


class FacturationProApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        if ($this->app->runningInConsole()) {

            // Publishing the Config file
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('facturation-pro-api.php'),
            ], 'config');

            // Publishing the views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/facturation-pro-api'),
            ], 'views');

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'facturation-pro-api');

        // Register the main class to use with the facade

        $this->app->bind('facturation-pro-api', function () {
            return new FacturationProApi();
        });
    }
}
