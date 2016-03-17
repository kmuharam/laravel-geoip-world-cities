<?php

namespace Moharrum\LaravelGeoIPWorldCities;

use Illuminate\Support\ServiceProvider;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;
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
            Config::configFilePath() => config_path(Config::$PUBLISHED_CONFIG_FILE_NAME)
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
            Config::configFilePath(),
            substr(
                Config::$PUBLISHED_CONFIG_FILE_NAME,
                0,
                strpos(
                    Config::$PUBLISHED_CONFIG_FILE_NAME,
                    '.'
                )
            )
        );
    }

    /**
     * Register the migration command.
     */
    private function registerMigrationCommand()
    {
        $this->app['command.cities.migration'] = $this->app->share(function($app) {
            return new CreateCitiesMigrationCommand($app);
        });

        $this->commands('command.cities.migration');
    }

    /**
     * Register the seeder command.
     */
    private function registerSeederCommand()
    {
        $this->app['command.cities.seeder'] = $this->app->share(function($app) {
            return new CreateCitiesSeederCommand($app);
        });

        $this->commands('command.cities.seeder');
    }
}