<?php

namespace App\ViewModels;

use App\Models\Organization;
use App\Models\PinKegBranch;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class EditPinKegBranchViewModel extends ViewModel
{
    /**
     * @var PinKegBranch.
     */
    protected $pinKegBranch;

    public function __construct(PinKegBranch $pinKegBranch)
    {
        $this->pinKegBranch = $pinKegBranch;
    }

    /**
     * @return PinKegBranch.
     */
    public function pin(): PinKegBranch
    {
        return $this->pinKegBranch;
    }

    /**
     * @return Collection.
     */
    public function orgs(): Collection
    {
        return Organization::with('branchs')->get();
    }
}
