<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;

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
                    ->nullable();
            
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