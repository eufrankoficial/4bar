<?php

namespace App\ViewModels;

use App\Repositories\Config\SensorRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ListSensorViewModel extends ViewModel
{
    /**
     * @var SensorRepository.
     */
    protected $sensorRepo;

    public function __construct(SensorRepository $sensorRepo)
    {
        $this->sensorRepo = $sensorRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function sensors(): LengthAwarePaginator
    {
        return $this->sensorRepo->all(20, true, ['type']);
    }

}
