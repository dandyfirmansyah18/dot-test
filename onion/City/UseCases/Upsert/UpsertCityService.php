<?php

namespace Onion\City\UseCases\Upsert;

use Onion\City\Repositories\CityRepositoryInterface;
use Onion\Entity\City;
use Onion\Province\Repositories\ProvinceRepositoryInterface;

class UpsertCityService implements UpsertCityInterface
{
    private $repository;

    public function __construct(CityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function upsert(UpsertCityModel $model): City {
        return $this->repository->upsert($model);
    }
}