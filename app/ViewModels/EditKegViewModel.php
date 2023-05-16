<?php

namespace App\ViewModels;

use App\Models\BeerType;
use App\Models\BranchDetail;
use App\Models\ColdChamber;
use App\Models\Keg;
use App\Models\Organization;
use App\Models\Supplier;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

/**
 * Class EditKegViewModel.
 * @package App\ViewModels.
 */
class EditKegViewModel extends ViewModel
{
    public function __construct(Keg $keg)
    {
        $this->keg = $keg;
        $this->keg->load(['beerType', 'supplier', 'taps']);
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
    public function orgs(): Collection
    {
        return Organization::get();
    }

    /**
     * @return Collection
     */
    public function beerTypes(): Collection
    {
        return BeerType::filter(request())
            ->whereIn('status', [BeerType::STATUS_APPROVED, BeerType::STATUS_PENDING])
            ->orWhere('branch_id', BranchDetail::SUPER_ADM_BAR)
            ->orderBy('id', 'desc')->get();
    }

    /**
     * @return Collection.
     */
    public function suppliers(): Collection
    {
        return Supplier::filter(request())->get();
    }

    /**
     * @return Collection.
     */
    public function coldChambers(): Collection
    {
        return ColdChamber::filter(request())->with(['sensor.device'])->get();
    }

    /**
     * @return array.
     */
    public function status()
    {
        return Keg::STATUS;
    }
}
