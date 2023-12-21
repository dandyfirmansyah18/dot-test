<?php

namespace Onion\Province\UseCases\Get;

use Onion\Province\Repositories\ProvinceRepositoryInterface;

class GetProvinceService implements GetProvinceInterface
{
    private $repository;

    public function __construct(ProvinceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get($id): array {
        if (!empty($id)) {
            return $this->repository->getById($id);
        } else {
            return $this->repository->get();
        }
    }
}