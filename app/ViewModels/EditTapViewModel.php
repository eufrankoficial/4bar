<?php

namespace App\ViewModels;

use App\Enuns\SensorEnum;
use App\Models\Keg;
use App\Models\Sensor;
use App\Models\Tap;
use Spatie\ViewModels\ViewModel;

class EditTapViewModel extends ViewModel
{
    /**
     * @var Tap.
     */
    protected $tap;

    public function __construct(Tap $tap)
    {
        $this->tap = $tap;
        $this->tap->load(['keg']);
    }

    public function tap(): Tap
    {
        return $this->tap;
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
        return Keg::filter(request())->get();
    }

}
