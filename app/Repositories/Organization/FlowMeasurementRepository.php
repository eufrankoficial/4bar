<?php

namespace App\Repositories\Organization;

use App\Models\FlowMeasurement;
use App\Repositories\BaseRepository;

/**
 * Class FlowMeasurementRepository.
 * @package App\Repositories\Organization.
 */
class FlowMeasurementRepository extends BaseRepository
{
    protected $modelClass = FlowMeasurement::class;

}
