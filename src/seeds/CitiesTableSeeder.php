<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->dump() as $dumpPart) {

            $query = "LOAD DATA LOCAL INFILE '"
                    . $dumpPart . "'
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
    protected function dump()
    {
        $files = [];

        foreach(File::allFiles(Config::dumpPath()) as $dumpFile) {
            $files[] = $dumpFile->getRealpath();
        }

        sort($files);
        
        return $files;
    }
}
