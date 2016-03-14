<?php

namespace Moharrum\LaravelGeoIPWorldCities\Helpers;

/*
 * \Moharrum\LaravelCities
 *
 * Copyright (c) 2015 - 2016 LaravelCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelCities
 * @license http://opensource.org/licenses/MIT MIT license
 * @version    0.1
 */

/**
 * @version    0.1
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
                .'dump'
                .DIRECTORY_SEPARATOR;
    }
}
