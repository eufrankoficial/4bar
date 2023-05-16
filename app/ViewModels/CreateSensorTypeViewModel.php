<?php

namespace App\ViewModels;

use App\Repositories\Organization\SensorTypeRepository;
use Spatie\ViewModels\ViewModel;

class CreateSensorTypeViewModel extends ViewModel
{
    /**
     * @var SensorTypeRepository.
     */
    protected $sensorTypeRepo;

    public function __construct(SensorTypeRepository $sensorTypeRepo)
    {
        $this->sensorTypeRepo = $sensorTypeRepo;
    }
}
