<?php

namespace App\Repositories\Organization;

use App\Models\SensorType;
use App\Repositories\BaseRepository;

class SensorTypeRepository extends BaseRepository
{
    protected $modelClass = SensorType::class;


    public function types()
    {
        return $this->model()->types;
    }
}
