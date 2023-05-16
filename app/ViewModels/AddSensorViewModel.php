<?php

namespace App\ViewModels;

use App\Models\Device;
use App\Models\SensorType;
use App\Repositories\Config\SensorRepository;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class AddSensorViewModel extends ViewModel
{
    /**
     * @var SensorRepository,
     */
    protected $sensorRepo;

    public function __construct(SensorRepository $sensorRepo)
    {
        $this->sensorRepo = $sensorRepo;
    }

    /**
     * @return Collection.
     */
    public function devices(): Collection
    {

        if(request()->get('device')) {
            return Device::where('slug', request()->get('device'))->get();
        }

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
