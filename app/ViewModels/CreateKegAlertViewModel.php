<?php

namespace App\ViewModels;

use App\Models\Keg;
use App\Models\Warning;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class CreateKegAlertViewModel extends ViewModel
{
    /**
     * @var Keg.
     */
    protected $keg;

    public function __construct(Keg $keg)
    {
        $this->keg = $keg;
        $this->keg->load(['warnings']);
    }

    /**
     * @return Keg.
     */
    public function keg()
    {
        return $this->keg;
    }

    /**
     * @return array.
     */
    public function types()
    {
        return Warning::$types;
    }

    /**
     * @return Collection
     */
    public function warnings(): Collection
    {
        return $this->keg->warnings;
    }
}
