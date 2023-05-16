<?php

namespace App\ViewModels;

use App\Models\SensorType;
use App\Repositories\Organization\SensorTypeRepository;
use Spatie\ViewModels\ViewModel;

class EditSensorTypeViewModel extends ViewModel
{
    /**
     * @var SensorType.
     */
    protected $sensorType;

    /**
     * @var SensorTypeRepository.
     */
    protected $sensorTypeRepo;

    public function __construct(SensorTypeRepository $sensorTypeRepo, SensorType $sensorType)
    {
        $this->sensorType = $sensorType;
        $this->sensorTypeRepo = $sensorTypeRepo;
    }

    /**
     * @return SensorType.
     */
    public function type(): SensorType
    {
        return $this->sensorType;
    }

    /**
     * @return array.
     */
    public function types(): array
    {
        return $this->sensorTypeRepo->types();
    }
}
