<?php

namespace Moharrum\LaravelGeoIPWorldCities;

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 4
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
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
     */
    public function boot()
    {
        $this->registerNamespaces();
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        $this->bind();

        $this->registerMigrationCommand();

        $this->registerSeederCommand();
    }

    /**
     * Register the package's component namespaces.
     */
    private function registerNamespaces()
    {
        $this->package('moharrum/laravel-geoip-world-cities', null, __DIR__);
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
     * Register the migration command.
     */
    private function registerMigrationCommand()
    {
        $this->app['command.cities.migration'] = $this->app->share(function ($app) {
            return new CreateCitiesMigrationCommand;
        });

        $this->commands('command.cities.migration');
    }

    /**
     * Register the seeder command.
     */
    private function registerSeederCommand()
    {
        $this->app['command.cities.seeder'] = $this->app->share(function ($app) {
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
