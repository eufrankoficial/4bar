<?php

namespace App\ViewModels;

use App\Models\Organization;
use App\Repositories\Organization\TapRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ListTapViewModel extends ViewModel
{
    /**
     * @var TapRepository.
     */
    protected $tapRepo;

    public function __construct(TapRepository $tapRepo)
    {
        $this->tapRepo = $tapRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function taps(): LengthAwarePaginator
    {
        return $this->tapRepo->model()->with(['keg'])->filter(request())->paginate();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection.
     */
    public function orgs()
    {
        return Organization::with(['branchs'])->get();
    }
}
