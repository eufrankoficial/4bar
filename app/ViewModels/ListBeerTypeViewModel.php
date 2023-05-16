<?php

namespace App\ViewModels;

use App\Models\BeerType;
use App\Models\BranchDetail;
use App\Repositories\Organization\BeerTypeRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

/**
 * Class ListBeerTypeViewModel.
 * @package App\ViewModels.
 */
class ListBeerTypeViewModel extends ViewModel
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
     * @return LengthAwarePaginator.
     */
    public function types(): LengthAwarePaginator
    {
        if(current_user()->hasRole('SuperAdmin')) {
            return $this->beerTypeRepo->model()->filter(request())
                ->orderBy('id', 'desc')->paginate();
        }

        return $this->beerTypeRepo->model()->filter(request())
            ->orWhere('branch_id', BranchDetail::SUPER_ADM_BAR)
            ->orderBy('id', 'desc')->paginate();
    }


    /**
     * @return array.
     */
    public function status(): array
    {
        return [
            BeerType::STATUS_PENDING,
            BeerType::STATUS_APPROVED
        ];
    }
}
