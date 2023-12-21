<?php

namespace Onion\City\UseCases\Upsert;

use Onion\Entity\City;

interface UpsertCityInterface
{
    public function upsert(UpsertCityModel $model): City;
}