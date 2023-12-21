<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Onion\City\Repositories\CityRepository;
use Onion\City\UseCases\Get\GetCityService;
use Onion\Controller\GetCitiesHandler;
use Onion\Controller\GetProvincesHandler;
use Onion\Province\Repositories\ProvinceRepository;
use Onion\Province\UseCases\Get\GetProvinceService;

class SearchController extends Controller
{
    public function getProvinces(Request $request) {
        return Response((new GetProvincesHandler(new GetProvinceService(new ProvinceRepository)))->handle($request));
    }

    public function getCities(Request $request) {
        return Response((new GetCitiesHandler(new GetCityService(new CityRepository)))->handle($request));
    }
}
