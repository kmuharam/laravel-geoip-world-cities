<?php

namespace Moharrum\LaravelGeoIPWorldCities;

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Support\ServiceProvider;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;
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
            Config::localConfigRealpath() => config_path(Config::$PUBLISHED_CONFIG_FILE_NAME)
        ]);
    }

    /**
     * Bind the package to the IoC container.
     */
    private function bind()
    {
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
            Config::localConfigRealpath(),
            Config::configKey()
        );
    }

    /**
     * Register the migration command.
     */
    private function registerMigrationCommand()
    {
        $this->app['command.cities.migration'] = $this->app->share(function($app) {
            return new CreateCitiesMigrationCommand;
        });

        $this->commands('command.cities.migration');
    }

    /**
     * Register the seeder command.
     */
    private function registerSeederCommand()
    {
        $this->app['command.cities.seeder'] = $this->app->share(function($app) {
            return new CreateCitiesSeederCommand;
        });

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