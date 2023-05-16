<?php

namespace App\ViewModels;

use App\Models\Device;
use App\Models\Sensor;
use App\Models\SensorType;
use App\Repositories\Config\SensorRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class EditSensorViewModel extends ViewModel
{
    /**
     * @var SensorRepository.
     */
    protected $sensorRepo;

    /**
     * @var Sensor.
     */
    protected $sensor;

    public function __construct(SensorRepository $sensorRepo, Sensor $sensor)
    {
        $this->sensorRepo = $sensorRepo;
        $this->sensor = $sensor;
    }

    /**
     * @return Sensor.
     */
    public function sensor():Sensor
    {
        return $this->sensor;
    }

    /**
     * @return Collection.
     */
    public function devices(): Collection
    {
        return Device::get();
    }

    /**
     * @return Collection.
     */
    public function sensorTypes(): Collection
    {
        return SensorType::get();
    }
}
