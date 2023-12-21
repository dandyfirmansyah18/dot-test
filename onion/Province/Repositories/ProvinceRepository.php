<?php 

namespace Onion\Province\Repositories;

use Onion\Entity\Province;
use Onion\Province\UseCases\Upsert\UpsertProvinceModel;

class ProvinceRepository implements ProvinceRepositoryInterface
{

    public function getById(int $id): array {
        return Province::select('id as province_id', 'name as province')->where('id', $id)->get()->toArray();
    }  

    public function get(): array {
        return Province::select('id as province_id', 'name as province')->get()->toArray();
    }

    public function upsert(UpsertProvinceModel $model): Province {
      // doing check first
      $province = Province::where('id', $model->province_id)->first();
      if (empty($province)) {
        $province = new Province();
        $province->id = $model->province_id;
      }
      $province->name = $model->name;
      $province->save();

      return $province;
    }

}