<?php

namespace App\ViewModels;

use App\Models\ColdChamber;
use App\Models\Keg;
use App\Models\Organization;
use App\Repositories\Organization\KegRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ListKegViewModel extends ViewModel
{
    /**
     * @var KegRepository.
     */
    protected $kegRepo;

    public function __construct(KegRepository $kegRepo)
    {
        $this->kegRepo = $kegRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function kegs(): LengthAwarePaginator
    {
        return $this->kegRepo->model()->with(['org', 'branchs', 'beerType'])
            ->filter(request())
            ->where('status', '!=', Keg::COLLECTED)
            ->orderBy('created_at', 'desc')
            ->paginate(30);
    }

    /**
     * @return Collection.
     */
    public function coldChambers(): Collection
    {
        return ColdChamber::with(['sensor.device'])->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection.
     */
    public function orgs()
    {
        return Organization::with(['branchs'])->get();
    }
}
