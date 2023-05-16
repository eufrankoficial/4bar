<?php

namespace App\ViewModels;

use App\Repositories\Organization\PinKegBranchRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ListPinViewModel extends ViewModel
{
    /**
     * @var PinKegRequestPost.
     */
    protected $pinKegRepo;

    public function __construct(PinKegBranchRepository $pinKegRepo)
    {
        $this->pinKegRepo = $pinKegRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function pins(): LengthAwarePaginator
    {
        return $this->pinKegRepo->model()->with(['org', 'branchs'])->filter(request())->paginate();
    }
}
