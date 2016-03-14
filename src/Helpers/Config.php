<?php

namespace Moharrum\LaravelGeoIPWorldCities\Helpers;

/*
 * \Moharrum\LaravelGeoIPWorldCities
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
 * @license http://opensource.org/licenses/MIT MIT license
 * @version    0.2
 */

/**
 * @version    0.2
 * 
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class Config
{
    /**
     * Returns the cities table name from config files.
     * 
     * @return string
     */
    public static function citiesTableName()
    {
        return config('cities.table');
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
     * Returns the full path to the seeder file.
     * 
     * @return string
     */
    public static function seeder()
    {
        return __DIR__
                .DIRECTORY_SEPARATOR
                .'..'
                .DIRECTORY_SEPARATOR
                .'seeds'
                .DIRECTORY_SEPARATOR
                .'CitiesTableSeeder.php';
    }

    /**
     * Returns the full path to the migration file.
     * 
     * @return string
     */
    public static function migration()
    {
        return __DIR__
                .DIRECTORY_SEPARATOR
                .'..'
                .DIRECTORY_SEPARATOR
                .'migrations'
                .DIRECTORY_SEPARATOR
                .'2016_03_10_114715_create_cities_table.php';
    }
}
