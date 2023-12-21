<?php

namespace Onion\ExternalServices\RajaOngkir\UseCases\Get;

use Illuminate\Support\Facades\Http;

class GetProvincesService 
{
    private const PATH_URL = "province";

    public function get()
    {
        $apiUrl = env("RAJAONGKIR_BASE_URL") . self::PATH_URL;
        $header = [
            'key' => env("RAJAONGKIR_API_KEY"),
        ];

        $response = Http::withHeaders($header)->get($apiUrl);
        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);

        if ($statusCode == 200) {
          return $responseBody;
        } else {
          // doing logging in here
          return [];
        }
    }
}