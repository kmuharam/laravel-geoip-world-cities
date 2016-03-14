<?php

namespace Moharrum\LaravelGeoIPWorldCities;

use Illuminate\Support\ServiceProvider;

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
            __DIR__.'/config/config.php' => config_path('cities.php'),
            __DIR__.'/migrations/2016_03_10_114715_create_cities_table.php' => base_path('database/migrations/2016_03_10_114715_create_cities_table.php'),
            __DIR__.'/seeds/CitiesTableSeeder.php' => base_path('database/seeds/CitiesTableSeeder.php'),
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
                return new City();
        });
        $this->mergeConfig();
    }

    /**
     * Merges user's and cities's configs.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'cities');
    }
}