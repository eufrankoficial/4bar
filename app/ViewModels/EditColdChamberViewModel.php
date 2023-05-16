<?php

namespace App\ViewModels;

use App\Enuns\SensorEnum;
use App\Models\ColdChamber;
use App\Models\Sensor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class EditColdChamberViewModel extends ViewModel
{
    /**
     * @var ColdChamber.
     */
    protected $coldChamber;

    public function __construct(ColdChamber $coldChamber)
    {
        $this->coldChamber = $coldChamber;
        $this->coldChamber->load(['sensor']);
    }

    /**
     * @return ColdChamber.
     */
    public function coldChamber(): ColdChamber
    {
        return $this->coldChamber;
    }

    /**
     * @return Collection.
     */
    public function sensors(): Collection
    {
        return Sensor::whereDoesntHave('coldChambers', function(Builder $query) {
            $query->where('id', '<>', $this->coldChamber->id);
        })->where('sensor_type_id', '=', SensorEnum::TEMPERATURE)->get();
    }
}
