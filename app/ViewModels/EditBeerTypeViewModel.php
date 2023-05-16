<?php

namespace App\ViewModels;

use App\Models\BeerType;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

/**
 * Class EditBeerTypeViewModel.
 * @package App\ViewModels.
 */
class EditBeerTypeViewModel extends ViewModel
{
    /**
     * @var BeerType.
     */
    protected $beerType;

    public function __construct(BeerType $beerType)
    {
        $this->beerType = $beerType;
    }

    /**
     * @return BeerType.
     */
    public function type(): BeerType
    {
        return $this->beerType;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection.
     */
    public function orgs(): Collection
    {
        return Organization::with(['branchs'])->get();
    }


}
