<?php

namespace App\ViewModels;

use App\Models\ColdChamber;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class CreateColdChamberAlertViewModel extends ViewModel
{
    protected $coldChamber;

    public function __construct(ColdChamber $coldChamber)
    {
        $this->coldChamber = $coldChamber;
        $this->coldChamber->load(['warnings']);
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
    public function warnings(): Collection
    {
        return $this->coldChamber->warnings;
    }
}
