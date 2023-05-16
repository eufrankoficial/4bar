<?php

namespace App\Repositories\Config;

use App\Models\Sensor;
use App\Repositories\BaseRepository;

class SensorRepository extends BaseRepository
{
    protected $modelClass = Sensor::class;

}
