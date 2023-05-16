<?php

namespace App\ViewModels;

use App\Repositories\Organization\SensorTypeRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ListSensorTypeViewModel extends ViewModel
{
    /**
     * @var SensorTypeRepository.
     */
    protected $sensorTypeRepo;

    public function __construct(SensorTypeRepository $sensorTypeRepo)
    {
        $this->sensorTypeRepo = $sensorTypeRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function types(): LengthAwarePaginator
    {
        return $this->sensorTypeRepo->all();
    }
}
