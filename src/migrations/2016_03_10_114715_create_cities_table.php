<?php

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2017 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2017 \Moharrum\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Config::citiesTableName(), function (Blueprint $table) {
            $table->increments('id');
            
            $table->char('country', 2)
                    ->nullable();
            
            $table->string('city')
                    ->nullable()
                    ->collation('utf8_unicode_ci');
            
            $table->string('city_ascii')
                    ->nullable();
            
            $table->char('region', 2)
                    ->nullable();

            $table->integer('population')
                    ->nullable()
                    ->unsigned();

            $table->decimal('latitude', 10, 6)
                    ->nullable();

            $table->decimal('longitude', 10, 6)
                    ->nullable();
            
            $table->index('country', 'idx_country');
            
            $table->index('region', 'idx_region');
            
            $table->index(['latitude', 'longitude'], 'idx_lat_long');
            
            $table->timestamps = false;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Config::citiesTableName());
    }
}