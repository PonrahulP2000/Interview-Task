<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class ImportCountryStateCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:country-state-city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import countries, states, and cities from JSON file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = storage_path('app/countries+states+cities.json');
        $data = json_decode(file_get_contents($path),true);

        foreach($data as $countryData){
            $country = Country::updateOrCreate(
                ['id' => $countryData['id']],
                ['country_name' => $countryData['name']]
            );

            foreach($countryData['states'] as $stateData){
                $state = State::updateOrCreate(
                    ['id' => $stateData['id']],
                    [
                        'country_id' => $country->id,
                        'state_name' => $stateData['name']
                    ]
                );

                foreach($stateData['cities'] as $cityData){
                    City::updateOrCreate(
                        ['id' => $cityData['id']],
                        [
                            'state_id' => $state->id,
                            'city_name' => $cityData['name']
                        ]
                    );
                }
            }
        }
        $this->info('Data imported successfully');
    }
}
