<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Onion\ExternalServices\RajaOngkir\UseCases\Get\GetProvincesService;
use Onion\Province\Repositories\ProvinceRepository;
use Onion\Province\UseCases\Upsert\UpsertProvinceModel;
use Onion\Province\UseCases\Upsert\UpsertProvinceService;

class GetProvincesFromProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:provinces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for Fetching Provinces from 3rd party';

    private $upsertProvinceSvc;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->upsertProvinceSvc = new UpsertProvinceService(new ProvinceRepository());
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $services = new GetProvincesService();
        $cities = $services->get();
        if (array_key_exists('rajaongkir', $cities)) {
            if ($cities['rajaongkir']['status']['code'] === 200) {
                $results = $cities['rajaongkir']['results'];
                foreach ($results as $key => $value) {
                    $modelUpsert = $this->parseToUpsertModel($value['province_id'], 
                                        $value['province']);
                    $this->upsertProvinceSvc->upsert($modelUpsert);
                }
            }
        }
        return "Upsert Province Finish";
    }

    private function parseToUpsertModel($province_id, $name)
    {
        $model = new UpsertProvinceModel();
        $model->province_id = $province_id;
        $model->name = $name;
        return $model;
    }
}
