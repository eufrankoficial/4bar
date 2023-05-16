<?php

namespace App\ViewModels;

use App\Models\Organization;
use App\Repositories\Organization\BeerTypeRepository;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

/**
 * Class CreateBeerTypeViewModel.
 * @package App\ViewModels.
 */
class CreateBeerTypeViewModel extends ViewModel
{
    /**
     * @var BeerTypeRepository.
     */
    protected $beerTypeRepo;

    public function __construct(BeerTypeRepository $beerTypeRepo)
    {
        $this->beerTypeRepo = $beerTypeRepo;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection.
     */
    public function orgs(): Collection
    {
        return Organization::with(['branchs'])->get();
    }
}
