<?php

namespace App\ViewModels;

use App\Models\BranchDetail;
use App\Models\Calendar;
use Spatie\ViewModels\ViewModel;

class CreateCalendarViewModel extends ViewModel
{
    /**
     * @var BranchDetail.
     */
    protected $branch;

    public function __construct(BranchDetail $branch)
    {
        $this->branch = $branch;
        $this->branch->load('org');
    }

    /**
     * @return BranchDetail.
     */
    public function branch(): BranchDetail
    {
        return $this->branch;
    }

    /**
     * @return array.
     */
    public function days(): array
    {
        return Calendar::WEEk_DAY;
    }
}
