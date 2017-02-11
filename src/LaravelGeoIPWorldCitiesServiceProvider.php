<?php

namespace Moharrum\LaravelGeoIPWorldCities;

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2017 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2017 \Moharrum\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Support\ServiceProvider;
use Moharrum\LaravelGeoIPWorldCities\Console\CreateCitiesSeederCommand;
use Moharrum\LaravelGeoIPWorldCities\Console\CreateCitiesMigrationCommand;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
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
        $this->publishConfig();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->bind();

        $this->mergeConfig();

        $this->registerMigrationCommand();

        $this->registerSeederCommand();
    }

    /**
     * Publish config files.
     */
    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php' => config_path('cities.php')
        ]);
    }

    /**
     * Bind the package to the IoC container.
     */
    private function bind()
    {
        if(((double) $this->app::VERSION) === 5.4) {
            $this->app->singleton('cities', function ($app) {
                return new City;
            });

            return;
        }

        $this->app['cities'] = $this->app->share(function ($app) {
            return new City;
        });
    }

    /**
     * Merges user's and cities's configs.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php',
            'cities'
        );
    }

    /**
     * Register the migration command.
     */
    private function registerMigrationCommand()
    {
        if(((double) $this->app::VERSION) === 5.4) {
            $this->app->singleton('command.cities.migration', function ($app) {
                return new CreateCitiesMigrationCommand;
            });
        } else {
            $this->app['command.cities.migration'] = $this->app->share(function($app) {
                return new CreateCitiesMigrationCommand;
            });
        }

        $this->commands('command.cities.migration');
    }

    /**
     * Register the seeder command.
     */
    private function registerSeederCommand()
    {
        if(((double) $this->app::VERSION) === 5.4) {
            $this->app->singleton('command.cities.seeder', function ($app) {
                return new CreateCitiesSeederCommand;
            });
        } else {
            $this->app['command.cities.seeder'] = $this->app->share(function($app) {
                return new CreateCitiesSeederCommand;
            });
        }

        $this->commands('command.cities.seeder');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cities'];
    }
}