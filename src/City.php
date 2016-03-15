<?php

namespace Moharrum\LaravelGeoIPWorldCities;

/*
 * \Moharrum\LaravelGeoIPWorldCities
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
 * @license http://opensource.org/licenses/MIT MIT license
 * @version    0.3
 */

use Illuminate\Database\Eloquent\Model;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;

/**
 * @version    0.3
 * 
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country',
        'city',
        'city_ascii',
        'region',
        'population',
        'latitude',
        'longitude',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * Create a new City instance.
     * 
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = Config::citiesTableName();
    }
}
