<?php

namespace Onion\City\UseCases\Get;

interface GetCityInterface
{
    public function get($id): array;
}