<?php 

namespace Onion\City\Repositories;

use Onion\City\UseCases\Upsert\UpsertCityModel;
use Onion\Entity\City;

interface CityRepositoryInterface {

    public function getById(int $id): array;

    public function get(): array;

    public function upsert(UpsertCityModel $model): City;
}