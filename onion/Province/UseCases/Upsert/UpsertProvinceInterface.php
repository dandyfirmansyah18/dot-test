<?php

namespace Onion\Province\UseCases\Upsert;

use Onion\Entity\Province;

interface UpsertProvinceInterface
{
    public function upsert(UpsertProvinceModel $model): Province;
}