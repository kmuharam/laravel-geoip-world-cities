<?php

namespace Moharrum\LaravelGeoIPWorldCities;

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2017 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2017 \Moharrum\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class Facade extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return 'cities';
    }
}
