<?php

namespace Onion\Province\UseCases\Get;

interface GetProvinceInterface
{
    public function get($id): array;
}