<?php

namespace DavidUmoh\LaravelOpenID;

use Illuminate\Support\ServiceProvider;

class LaravelOpenIDServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'davidumoh');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'davidumoh');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelopenid.php', 'laravelopenid');

        // Register the service the package provides.
        $this->app->singleton('laravelopenid', function ($app) {
            return new LaravelOpenID;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelopenid'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelopenid.php' => config_path('laravelopenid.php'),
        ], 'laravelopenid.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/davidumoh'),
        ], 'laravelopenid.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/davidumoh'),
        ], 'laravelopenid.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/davidumoh'),
        ], 'laravelopenid.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
