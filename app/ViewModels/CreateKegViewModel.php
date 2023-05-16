<?php

namespace App\ViewModels;

use App\Models\BeerType;
use App\Models\BranchDetail;
use App\Models\ColdChamber;
use App\Models\Keg;
use App\Models\Organization;
use App\Models\Supplier;
use App\Repositories\Organization\KegRepository;
use DemeterChain\B;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class CreateKegViewModel extends ViewModel
{
    /**
     * @var KegRepository.
     */
    protected $kegRepo;

    public function  __construct(KegRepository $kegRepo)
    {
        $this->kegRepo = $kegRepo;
    }

    public function orgs(): Collection
    {
        return Organization::with('branchs')->get();
    }

    /**
     * @return Collection
     */
    public function beerTypes(): Collection
    {
        $beerTypesBranch = BeerType::filter(request())
            ->whereIn('status', [BeerType::STATUS_APPROVED, BeerType::STATUS_PENDING])
            ->orderBy('id', 'desc')->get();

        $approveds = BeerType::whereIn('status', [BeerType::STATUS_APPROVED])
                    ->whereNotIn('id', $beerTypesBranch->pluck('id')->toArray())
                    ->get();

        return $beerTypesBranch->merge($approveds);
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
     * @return Collection.
     */
    public function pins(): Collection
    {
        $pins = branch() ? branch()->pins : collect([]);
        $registered = $this->kegRepo->model()->filter(request())->pluck('pin_keg')->toArray();

        $pins = $pins->filter(function($pin) use ($registered){
            return !$pin->used && !in_array($pin->pin, $registered);
        });

        return $pins;
    }

    /**
     * @return array.
     */
    public function status()
    {
        return Keg::STATUS;
    }

}
