<?php

namespace Onion\Controller;

use Onion\Province\UseCases\Get\GetProvinceInterface;
use Illuminate\Http\Request;
use Onion\City\UseCases\Get\GetCityInterface;

class GetCitiesHandler
{
    private $service;

    public function __construct(GetCityInterface $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request)
    {
      try {
        $requests = $this->handleFilterRequestOnlyId($request->all());
        $getData = $this->service->get($requests['id'] ?? null);
        return [
          'status' => [
            'code' => 200,
            'description' => 'OK'
          ],
          'results' => $getData
        ];
      } catch (\Exception $e) {
        return [
          'status' => [
            'code' => $e->getCode(),
            'description' => $e->getMessage(),
          ]
        ];
      }
    }

    private function handleFilterRequestOnlyId(array $requests)
    {
        if (!empty($requests)) {
            if (in_array('id', array_keys($requests))) {
                return ['id' => $requests['id']]; // just need Id only
            }
        }
        return [];
    }
}