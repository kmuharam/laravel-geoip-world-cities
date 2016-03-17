<?php

namespace Moharrum\LaravelGeoIPWorldCities\Helpers;

/*
 * \Moharrum\LaravelGeoIPWorldCities
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
 * @license http://opensource.org/licenses/MIT MIT license
 * @version    0.4
 */

/**
 * @version    0.4
 * 
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class Config
{
    /**
     * @var string The config file name.
     */
    public static $CONFIG_FILE_NAME = 'config.php';

    /**
     * @var string The config file name.
     */
    public static $PUBLISHED_CONFIG_FILE_NAME = 'cities.php';

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
        return config(
            substr(
                Config::$PUBLISHED_CONFIG_FILE_NAME,
                0,
                strpos(
                    Config::$PUBLISHED_CONFIG_FILE_NAME,
                    '.'
                )
            ).'.table'
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
     * Returns the full path to the seeder file.
     * 
     * @return string
     */
    public static function seederPath()
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
     * Returns the full path to the migration file.
     * 
     * @return string
     */
    public static function migrationPath()
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
     * Returns the full path to the config file.
     * 
     * @return string
     */
    public static function configFilePath()
    {
        return __DIR__
                .DIRECTORY_SEPARATOR
                .'..'
                .DIRECTORY_SEPARATOR
                .'config'
                .DIRECTORY_SEPARATOR
                .static::$CONFIG_FILE_NAME;
    }
}
