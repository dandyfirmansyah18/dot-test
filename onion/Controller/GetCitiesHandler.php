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
          'results' => $this->parseToResponse($getData)
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

    private function parseToResponse(array $data)
    {
        $response = [];
        foreach ($data as $dt) {
            $res = [
              'city_id' => $dt['id'],
              'province_id' => $dt['province_id'],
              'province' => $dt['province']['name'],
              'type' => $dt['type'],
              'city_name' => $dt['name'],
              'postal_code' => $dt['postal_code'],
            ];

            $response[] = $res;
        }
        return $response;
    }
}