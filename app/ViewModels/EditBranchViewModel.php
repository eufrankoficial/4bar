<?php

namespace App\ViewModels;

use App\Models\BranchDetail;
use App\Models\Calendar;
use App\Models\Organization;
use Spatie\ViewModels\ViewModel;


/**
 * Class EditBranchViewModel
 * @package App\ViewModels.
 */
class EditBranchViewModel extends ViewModel
{
    /**
     * @var BranchDetail.
     */
    protected $branch;

    public function __construct(BranchDetail $branch)
    {
        $this->branch = $branch;
        $this->branch()->load(['org', 'calendars']);
    }

    /**
     * @return BranchDetail.
     */
    public function branch(): BranchDetail
    {
        return $this->branch;
    }

    /**
     * @return Organization.
     */
    public function org(): Organization
    {
        return $this->branch->org;
    }

    /**
     * @return mixed
     */
    public function calendars()
    {
        return $this->branch->calendars;
    }

    /**
     * @return array.
     */
    public function days(): array
    {
        return Calendar::WEEk_DAY;
    }
}
