<?php

namespace Moharrum\LaravelGeoIPWorldCities;

use Illuminate\Support\ServiceProvider;
use Moharrum\LaravelGeoIPWorldCities\Console\CreateCitiesSeederCommand;
use Moharrum\LaravelGeoIPWorldCities\Console\CreateCitiesMigrationCommand;

class LaravelGeoIPWorldCitiesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('cities.php')
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['cities'] = $this->app->share(function ($app) {
                return new City;
        });

        $this->mergeConfig();

        $this->app['command.cities.migration'] = $this->app->share(function($app)
        {
            return new CreateCitiesMigrationCommand($app);
        });

        $this->app['command.cities.seeder'] = $this->app->share(function($app)
        {
            return new CreateCitiesSeederCommand($app);
        });

        $this->commands('command.cities.migration');

        $this->commands('command.cities.seeder');
    }

    /**
     * Merges user's and cities's configs.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'cities');
    }
}