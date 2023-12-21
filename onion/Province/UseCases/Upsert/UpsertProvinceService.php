<?php

namespace Onion\Province\UseCases\Upsert;

use Onion\Entity\Province;
use Onion\Province\Repositories\ProvinceRepositoryInterface;

class UpsertProvinceService implements UpsertProvinceInterface
{
    private $repository;

    public function __construct(ProvinceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function upsert(UpsertProvinceModel $model): Province {
        return $this->repository->upsert($model);
    }
}