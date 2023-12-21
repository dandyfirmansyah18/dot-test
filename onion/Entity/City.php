<?php

namespace Onion\Entity;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function province()
    {
        return $this->belongsTo('Onion\Entity\Province', 'province_id');
    }
}
