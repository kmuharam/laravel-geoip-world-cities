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
class CreateCitiesSeederCommand extends Command
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'cities:seeder';

    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the cities table seeder.';

    /**
     * @var string The seeder file name.
     */
    public $seeder_file = 'CitiesTableSeeder.php';

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

        if (File::exists($this->publishedSeederRealpath())) {
            $exists = true;

            if (!$this->confirm('The seeder file already exists, overwrite it? [Yes|no]')) {
                return $this->info('Okay, no changes made to the file.');
            }
        }

        try {
            if(! $exists) {
                $this->callSilent('make:seed', ['name' => substr($this->seeder_file, 0, strpos($this->seeder_file, '.'))]);
            }
        } catch (\Exception $ex) {

        }

        $inputFile = file_get_contents($this->localSeederPath());

        $outputFile = fopen($this->publishedSeederRealpath(), 'w');

        if ($inputFile && $outputFile) {
            fwrite($outputFile, $inputFile);

            fclose($outputFile);
        } else {
            File::delete($this->publishedSeederRealpath());

            return $this->error(
                        'There was an error creating the seeder file, '
                        .'check write permissions for ' . base_path('database') . DIRECTORY_SEPARATOR . 'seeds'
                        .PHP_EOL
                        .PHP_EOL
                        .'If you think this is a bug, please submit a bug report '
                        .'at https://github.com/moharrum/laravel-geoip-world-cities/issues'
                    );
        }

        if(! $exists) {
            $this->info('Okay, seeder file created successfully.');

            return;
        }

        $this->info('Okay, seeder file overwritten successfully.');
    }

    /**
     * Returns the full path to the local seeder file.
     * 
     * @return string
     */
    protected function localSeederPath()
    {
        return __DIR__
                . DIRECTORY_SEPARATOR
                . '..'
                . DIRECTORY_SEPARATOR
                . 'seeds'
                . DIRECTORY_SEPARATOR
                . $this->seeder_file;
    }

    /**
     * Returns the full path to the published seeder file.
     * 
     * @return string
     */
    protected function publishedSeederRealpath()
    {
        return base_path(
                'database'
                . DIRECTORY_SEPARATOR
                . 'seeds'
                . DIRECTORY_SEPARATOR
                . $this->seeder_file
            );
    }
}
