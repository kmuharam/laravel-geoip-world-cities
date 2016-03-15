<?php

namespace Moharrum\LaravelGeoIPWorldCities\Console;

use Illuminate\Console\Command;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;

class CreateCitiesSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
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
        $this->line('');
        $this->info('We will create a seeder file for the cities table');
        $this->line('');

        if($this->confirm("Proceed with the seeder creation? [Yes|no]")) {
            $this->line('');

            $this->info("Creating seeder file...");

            $this->callSilent('make:seed', [
                                            'name' => substr(
                                                        Config::$SEEDER_FILE_NAME,
                                                        0,
                                                        strpos(
                                                            Config::$SEEDER_FILE_NAME,
                                                            '.'
                                                        )
                                                    )
                                            ]
                    );

            $inputFile = file_get_contents(Config::seederPath());

            $outputFile = fopen(
                            base_path(
                                'database'
                                .DIRECTORY_SEPARATOR
                                .'seeds'
                                .DIRECTORY_SEPARATOR
                                .Config::$SEEDER_FILE_NAME
                            ),
                            'w'
                        );

            if($inputFile && $outputFile) {
                fwrite($outputFile, $inputFile);
                fclose($outputFile);
            } else {
                return $this->error(
                            "Could not create the seeder file.\n Check write permissions "
                            ."for database/seeds directory"
                        );
            }

            $this->line('');

            $this->info('Seeder created.');

            $this->line('');
        }
    }
}
