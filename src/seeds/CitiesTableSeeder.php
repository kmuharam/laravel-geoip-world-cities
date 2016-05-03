<?php

/*
 * \Moharrum\LaravelGeoIPWorldCities for Laravel 5
 *
 * Copyright (c) 2015 - 2016 LaravelGeoIPWorldCities
 *
 * @copyright  Copyright (c) 2015 - 2016 \Moharrum\LaravelGeoIPWorldCities
 * 
 * @license http://opensource.org/licenses/MIT MIT license
 */

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->dumpFiles() as $dumpPart) {

            $query = "LOAD DATA LOCAL INFILE '"
                    . str_replace('\\', '/', $dumpPart) . "'
                    INTO TABLE `" . Config::citiesTableName() . "` 
                        FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'
                        LINES TERMINATED BY '\n' IGNORE 1 LINES
                        (country,
                        city_ascii,
                        city,
                        region,
                        population,
                        latitude,
                        longitude
                    )";

            DB::connection()->getpdo()->exec($query);

        }
    }

    /**
     * Returns an array containing the full path to each dump file.
     * 
     * @return array
     */
    private function dumpFiles()
    {
        $files = [];

        foreach(File::allFiles(Config::dumpPath()) as $dumpFile) {
            $files[] = $dumpFile->getRealpath();
        }

        sort($files);

        return $files;
    }
}
