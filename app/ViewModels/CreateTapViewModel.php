<?php

namespace App\ViewModels;

use App\Enuns\SensorEnum;
use App\Models\Keg;
use App\Models\Sensor;
use App\Repositories\Organization\TapRepository;
use Spatie\ViewModels\ViewModel;

class CreateTapViewModel extends ViewModel
{
    protected $tapRepo;

    public function __construct(TapRepository $tapRepo)
    {
        $this->tapRepo = $tapRepo;
    }

    public function sensors()
    {
        $sensors = Sensor::with(['device', 'type']);

        if(branch()) {
            $sensors = $sensors->whereHas('device', function($query) {
                $query->where('branch_id', branch()->id);
            });
        }

        return $sensors
            ->whereDoesntHave('tap')
            ->where('sensor_type_id', '=', SensorEnum::FLOW)
            ->get();
    }


    public function kegs()
    {
        return Keg::whereDoesntHave('taps')->filter(request())->get();
    }


}
