<?php

namespace App\ViewModels;

use App\Models\BranchDetail;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

/**
 * Class ListCalendarViewModel.
 * @package App\ViewModels.
 */
class ListCalendarViewModel extends ViewModel
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
     * @return LengthAwarePaginator
     */
    public function calendars(): LengthAwarePaginator
    {
        return $this->branch->calendars()->paginate();
    }
}
