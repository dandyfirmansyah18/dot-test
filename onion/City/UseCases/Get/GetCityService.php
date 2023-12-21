<?php

namespace Onion\City\UseCases\Get;

use Onion\City\Repositories\CityRepositoryInterface;

class GetCityService implements GetCityInterface
{
    private $repository;

    public function __construct(CityRepositoryInterface $repository)
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