<?php 

namespace Onion\Province\Repositories;

use Onion\Entity\Province;
use Onion\Province\UseCases\Upsert\UpsertProvinceModel;

interface ProvinceRepositoryInterface {

    public function getById(int $id): array;

    public function get(): array;

    public function upsert(UpsertProvinceModel $model): Province;
}