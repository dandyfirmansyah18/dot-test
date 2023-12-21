<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Onion\City\Repositories\CityRepository;
use Onion\City\UseCases\Upsert\UpsertCityModel;
use Onion\City\UseCases\Upsert\UpsertCityService;
use Onion\ExternalServices\RajaOngkir\UseCases\Get\GetCitiesService;

class GetCitiesFromProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for Fetching Cities from 3rd party';


    private $upsertCitySvc;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->upsertCitySvc = new UpsertCityService(new CityRepository());
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $services = new GetCitiesService();
        $cities = $services->get();
        if (array_key_exists('rajaongkir', $cities)) {
            if ($cities['rajaongkir']['status']['code'] === 200) {
                $results = $cities['rajaongkir']['results'];
                foreach ($results as $key => $value) {
                    $modelUpsert = $this->parseToUpsertModel($value['city_id'], $value['province_id'], 
                                        $value['city_name'], $value['type'], $value['postal_code']);
                    $this->upsertCitySvc->upsert($modelUpsert);
                }
            }
        }
        return "Upsert Cities Finish";
    }

    private function parseToUpsertModel($city_id, $province_id, $name, $type, $post_code)
    {
        $model = new UpsertCityModel();
        $model->city_id = $city_id;
        $model->province_id = $province_id;
        $model->name = $name;
        $model->postal_code = $post_code;
        $model->type = $type;
        return $model;
    }
}
