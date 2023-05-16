<?php

namespace App\Repositories\Organization;

use App\Models\Tap;
use App\Models\TemperatureMeasurement;
use App\Repositories\BaseRepository;

/**
 * Class TemperatureMeasurementRepository.
 * @package App\Repositories\Organization.
 */
class TemperatureMeasurementRepository extends BaseRepository
{
    protected $modelClass = TemperatureMeasurement::class;

}
