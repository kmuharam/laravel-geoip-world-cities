# laravel-geoip-world-cities

[![Latest Stable Version](https://poser.pugx.org/moharrum/laravel-geoip-world-cities/v/stable)](https://packagist.org/packages/moharrum/laravel-geoip-world-cities) [![Total Downloads](https://poser.pugx.org/moharrum/laravel-geoip-world-cities/downloads)](https://packagist.org/packages/moharrum/laravel-geoip-world-cities) [![Latest Unstable Version](https://poser.pugx.org/moharrum/laravel-geoip-world-cities/v/unstable)](https://packagist.org/packages/moharrum/laravel-geoip-world-cities) [![License](https://poser.pugx.org/moharrum/laravel-geoip-world-cities/license)](https://packagist.org/packages/moharrum/laravel-geoip-world-cities)

Laravel GeoIP World Cities is package that provides [MaxMind](https://www.maxmind.com/en/free-world-cities-database) Free World Cities Database support for laravel applications.

## Contents

- [Introduction](#introduction)
- [Choosing your version](#choosing-your-version)
- [Installation](#installation)
- [Table structure](#table-structure)
- [Example](#example)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Introduction

Includes city, region, country, latitude and longitude. This database doesn't contain any IP addresses. It's simply a listing of all the cities in the world.

This package simply loads the data provided in `worldcitiespop.txt.gz` file by [MaxMind](https://www.maxmind.com/) into a database and provides a `City` model to query the table.

## Choosing your version

If you are looking for the Laravel 4 version, take a look [Branch 1.0](https://github.com/moharrum/laravel-geoip-world-cities/tree/1.0).

If you are looking for the Laravel 5.0.* version, take a look [Branch 2.0](https://github.com/moharrum/laravel-geoip-world-cities/tree/2.0).

If you are looking for the Laravel 5.1.* and 5.2.* version, the following instructions are for you.

## Installation

**Note: This package is a bit large, ~40MB, installing and seeding the data could take a while.**

Add `moharrum/laravel-geoip-world-cities` to `composer.json`:

    "moharrum/laravel-geoip-world-cities": "3.*"

Run `composer update` to pull down the latest version of Cities.

Edit `config/app.php` and add the `provider`

```php
    'providers' => [
        Moharrum\LaravelGeoIPWorldCities\LaravelGeoIPWorldCitiesServiceProvider::class,
    ]
```

Optionally add the alias.

```php
    'aliases' => [
        'Cities' => Moharrum\LaravelGeoIPWorldCities\Facade::class,
    ]
```

Configure MySQL and PDO, insert the following code in `config/database.php`:

```php
    'mysql' => [
        'options'   => [PDO::MYSQL_ATTR_LOCAL_INFILE => true],
    ],
```

Publishing the configuration file, this is where you can change the default table name

    php artisan vendor:publish

Publishing the migration and seeder files

    php artisan cities:migration
    php artisan cities:seeder

To make sure the data is seeded insert the following code in `seeds/DatabaseSeeder.php`

```php
    // Seeding the cities
    $this->call(CitiesTableSeeder::class);
    $this->command->info('Seeded the cities table ...'); 
```

You may now run:

    php artisan migrate --seed
    
After running this command the filled cities table will be available

## Table structure

| id       | country  | city      | city_ascii  | region  | population  | latitude  | longitude  |
| -------- | ---------| --------- | ----------- | ------- | ----------- | --------- | ---------- |
| ..       | ..       | ..        | ..          | ..      | ..          | ..        | ..         |
| 2685662  | sd       | Khartoum  | khartoum    | 29      | 1974780     | 15.588056 | 32.534167  |
| ..       | ..       | ..        | ..          | ..      | ..          | ..        | ..         |

## Example

The package provides a `City` model which can be used to query the data

```php
    \Moharrum\LaravelGeoIPWorldCities\City::whereCity('Khartoum')->first();
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Credits

- [Khalid Moharrum][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-packagist]: https://packagist.org/packages/moharrum/laravel-geoip-world-cities
[link-downloads]: https://packagist.org/packages/moharrum/laravel-geoip-world-cities
[link-author]: https://github.com/moharrum
[link-contributors]: ../../contributors
