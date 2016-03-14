<?php

namespace Moharrum\LaravelGeoIPWorldCities\Console;

use Illuminate\Console\Command;
use Moharrum\LaravelGeoIPWorldCities\Helpers\Config;

class CreateCitiesMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
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
        $this->info('We will create a migration file for the cities table');
        $this->line('');

        if($this->confirm("Proceed with the migration creation? [Yes|no]")) {
            $this->line('');

            $this->info("Creating migration file...");

            $inputFile = file_get_contents(Config::migrationPath());

            $outputFile = fopen(
                            base_path(
                                'database'
                                .DIRECTORY_SEPARATOR
                                .'migrations'
                                .DIRECTORY_SEPARATOR
                                .Config::$MIGRATION_FILE_NAME
                            ),
                            'w'
                        );

            if($inputFile && $outputFile) {
                fwrite($outputFile, $inputFile);
                fclose($outputFile);
            } else {
                return $this->error(
                            "Could not create the seeder file.\n Check write permissions "
                            ."for database/migrations directory"
                        );
            }

            $this->line('');

            $this->info('Migration created.');

            $this->line('');
        }
    }
}
