<?php 

namespace Onion\City\Repositories;

use Onion\City\UseCases\Upsert\UpsertCityModel;
use Onion\Entity\City;

class CityRepository implements CityRepositoryInterface
{
    public function getById(int $id): array {
        return City::with('province')->where('id', $id)->get()->toArray();
    }  

    public function get(): array {
        return City::with('province')->get()->toArray();
    }

    public function upsert(UpsertCityModel $model): City {
        // doing check first
        $city = City::where('id', $model->city_id)->first();
        if (empty($city)) {
          $city = new City();
          $city->id = $model->city_id;
        }
        $city->province_id = $model->province_id;
        $city->name = $model->name;
        $city->postal_code = $model->postal_code;
        $city->type = $model->type;
        $city->save();

        return $city;

    }
}