<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= \Moharrum\LaravelCities\Config::$PARTS_NUM; $i++) {
            
            $query = "LOAD DATA LOCAL INFILE '" . \Moharrum\LaravelCities\Config::dumpPath()
                    . "worldcitiespop_part{$i}.txt" . "'
                    INTO TABLE `".\Moharrum\LaravelCities\Config::citiesTableName()."` 
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

            \Illuminate\Support\Facades\DB::connection()->getpdo()->exec($query);
            
        }
    }
}
