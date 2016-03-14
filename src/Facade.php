<?php

namespace Moharrum\LaravelGeoIPWorldCities;

/*
 * \Moharrum\LaravelGeoIPWorldCities
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
 * @license http://opensource.org/licenses/MIT MIT license
 * @version    0.1
 */

use Illuminate\Support\Facades\Facade;

/**
 * @version    0.1
 * 
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class City extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cities';
    }
}
