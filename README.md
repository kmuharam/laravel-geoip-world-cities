# laravel-geoip-world-cities

Laravel GeoIP World Cities is package that provides [MaxMind](https://www.maxmind.com/en/free-world-cities-database) Free World Cities Database support for laravel applications.

**Note: This package is a bit large, ~40MB, installing and seeding the data could take a while.**

## Introduction

Includes city, region, country, latitude and longitude. This database doesn't contain any IP addresses. It's simply a listing of all the cities in the world.

This package simply loads the data provided in `worldcitiespop.txt.gz` file provided by [MaxMind](https://www.maxmind.com/) into a database and provides a `model` to manipulate the table.

## Install

Add `moharrum/laravel-geoip-world-cities` to `composer.json`:

    "moharrum/laravel-geoip-world-cities": "dev-master"

Run `composer update` to pull down the latest version of Cities.

Edit `config/app.php` and add the `provider`

    'providers' => [
        Moharrum\LaravelGeoIPWorldCities\LaravelGeoIPWorldCitiesServiceProvider::class,
    ]

Optionally add the alias.

    'aliases' => [
        'Cities' => Moharrum\LaravelGeoIPWorldCities\Facade::class,
    ]

Publishing the configuration file, this is where you can change the default table name

    $ php artisan vendor:publish

Publishing the migration and seeder files

    $ php artisan cities:migration
    $ php artisan cities:seeder

To make sure the data is seeded insert the following code in `seeds/DatabaseSeeder.php`

    // Seeding the cities
    $this->call(CitiesTableSeeder::class);
    $this->command->info('Seeded the cities table ...'); 

Configure MySQL and PDO, insert the following code in `config/database.php`:

    // ...
    'mysql' => [
        'driver'    => 'mysql',
        // ...
        'options'   => [PDO::MYSQL_ATTR_LOCAL_INFILE => true],
        // ...
    ],

You may now run:

    $ php artisan migrate --seed
    
After running this command the filled cities table will be available

## Table structure

| id    | country  | city  | city_ascii  | region  | population  | latitude  | longitude  |
| ----- | -------- | ----- | ----------- | ------- | ----------- | --------- | ---------- |
| 1     | XY       | XY    | XY          | XY      | XY          | XY        | XY         |
| n     | ..       | ..    | ..          | ..      | ..          | ..        | ..         |

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

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
