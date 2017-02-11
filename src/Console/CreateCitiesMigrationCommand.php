<?php

namespace Moharrum\LaravelGeoIPWorldCities\Console;

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2017 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2017 \Moharrum\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class CreateCitiesMigrationCommand extends Command
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'cities:migration';

    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the cities table migration file.';

    /**
     * @var string The migration file name.
     */
    public $migration_file = '2016_03_10_114715_create_cities_table.php';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $exists = false;

        if (File::exists($this->publishedMigrationRealpath())) {
            $exists = true;

            if (!$this->confirm('The migration file already exists, overwrite it? [Yes|no]')) {
                return $this->info('Okay, no changes made to the file.');
            }
        }

        $inputFile = file_get_contents($this->localMigrationRealpath());

        $outputFile = fopen($this->publishedMigrationRealpath(), 'w');

        if ($inputFile && $outputFile) {
            fwrite($outputFile, $inputFile);

            fclose($outputFile);
        } else {
            File::delete($this->publishedMigrationRealpath());

            return $this->error(
                        'There was an error creating the migration file, '
                        .'check write permissions for ' . base_path('database') . DIRECTORY_SEPARATOR . 'migrations'
                        .PHP_EOL
                        .PHP_EOL
                        .'If you think this is a bug, please submit a bug report '
                        .'at https://github.com/moharrum/laravel-geoip-world-cities/issues'
                    );
        }

        if(! $exists) {
            $this->info('Okay, migration file created successfully.');

            return;
        }

        $this->info('Okay, migration file overwritten successfully.');
    }

    /**
     * Returns the full path to the local migration file.
     * 
     * @return string
     */
    protected function localMigrationRealpath()
    {
        return __DIR__
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . 'migrations'
                . DIRECTORY_SEPARATOR
                . $this->migration_file;
    }

    /**
     * Returns the full path to the published migration file.
     * 
     * @return string
     */
    protected function publishedMigrationRealpath()
    {
        return base_path(
                'database'
                . DIRECTORY_SEPARATOR
                . 'migrations'
                . DIRECTORY_SEPARATOR
                . $this->migration_file
            );
    }
}
