<?php

namespace Moharrum\LaravelGeoIPWorldCities\Helpers;

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 4
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Support\Facades\Config as IlluminateConfig;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class Config
{
    /**
     * @var string The seeder file name.
     */
    public static $SEEDER_FILE_NAME = 'CitiesTableSeeder.php';

    /**
     * @var string The migration file name.
     */
    public static $MIGRATION_FILE_NAME = '2016_03_10_114715_create_cities_table.php';

    /**
     * Returns the cities table name from config files.
     * 
     * @return string
     */
    public static function citiesTableName()
    {
        return IlluminateConfig::get(
            'laravel-geoip-world-cities::table'
        );
    }

    /**
     * Returns the full path to the dump file(s).
     * 
     * @return string
     */
    public static function dumpPath()
    {
        return __DIR__
                .DIRECTORY_SEPARATOR
                .'..'
                .DIRECTORY_SEPARATOR
                .'dump'
                .DIRECTORY_SEPARATOR;
    }

    /**
     * Returns the full path to the local seeder file.
     * 
     * @return string
     */
    public static function localSeederPath()
    {
        return __DIR__
                .DIRECTORY_SEPARATOR
                .'..'
                .DIRECTORY_SEPARATOR
                .'seeds'
                .DIRECTORY_SEPARATOR
                .static::$SEEDER_FILE_NAME;
    }

    /**
     * Returns the full path to the published seeder file.
     * 
     * @return string
     */
    public static function publishedSeederRealpath()
    {
        return base_path(
                'app'
                .DIRECTORY_SEPARATOR
                .'database'
                .DIRECTORY_SEPARATOR
                .'seeds'
                .DIRECTORY_SEPARATOR
                .self::$SEEDER_FILE_NAME
            );
    }

    /**
     * Returns the full path to the local migration file.
     * 
     * @return string
     */
    public static function localMigrationRealpath()
    {
        return __DIR__
                .DIRECTORY_SEPARATOR
                .'..'
                .DIRECTORY_SEPARATOR
                .'migrations'
                .DIRECTORY_SEPARATOR
                .static::$MIGRATION_FILE_NAME;
    }

    /**
     * Returns the full path to the published migration file.
     * 
     * @return string
     */
    public static function publishedMigrationRealpath()
    {
        return base_path(
                'app'
                .DIRECTORY_SEPARATOR
                .'database'
                .DIRECTORY_SEPARATOR
                .'migrations'
                .DIRECTORY_SEPARATOR
                .self::$MIGRATION_FILE_NAME
            );
    }
}
