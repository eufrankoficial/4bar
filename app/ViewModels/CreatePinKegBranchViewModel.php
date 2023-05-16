<?php

namespace App\ViewModels;

use App\Models\Organization;
use App\Repositories\Organization\PinKegBranchRepository;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class CreatePinKegBranchViewModel extends ViewModel
{
    /**
     * @var PinKegBranchRepository.
     */
    protected $pinKegBranchRepo;

    public function __construct(PinKegBranchRepository $pinKegBranchRepo)
    {
        $this->pinKegBranchRepo = $pinKegBranchRepo;
    }

    /**
     * @return Collection.
     */
    public function orgs(): Collection
    {
        return Organization::with('branchs')->get();
    }
}
