<?php

namespace App\ViewModels;

use App\Models\Keg;
use App\Models\Tap;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class AttrTapToBarrelViewModel extends ViewModel
{
    /**
     * @var Keg.
     */
    protected $keg;

    public function __construct(Keg $keg)
    {
        $this->keg = $keg;
        $this->keg->load(['taps']);
    }

    /**
     * @return Keg.
     */
    public function keg(): Keg
    {
        return $this->keg;
    }

    /**
     * @return Collection.
     */
    public function taps(): Collection
    {
        return Tap::filter(request())->whereDoesntHave('keg')->get();
    }
}
