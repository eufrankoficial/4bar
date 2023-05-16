<?php

namespace App\ViewModels;

use App\Models\Calendar;
use App\Models\Organization;
use Spatie\ViewModels\ViewModel;

/**
 * Class CreateBranchViewModel.
 * @package App\ViewModels.
 */
class CreateBranchViewModel extends ViewModel
{
    /**
     * @var Organization.
     */
    protected $org;

    public function __construct(Organization $org = null)
    {
        $this->org = $org;
    }

    /**
     * @return Organization.
     */
    public function org()
    {
        if(current_user()->organization)
            return current_user()->organization;

        return $this->org;
    }

    /**
     * @return mixed
     */
    public function orgs()
    {
        return Organization::with(['branchs'])->get();
    }

    /**
     * @return array.
     */
    public function days(): array
    {
        return Calendar::WEEk_DAY;
    }
}
