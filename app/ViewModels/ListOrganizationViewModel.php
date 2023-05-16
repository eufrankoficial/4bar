<?php

namespace App\ViewModels;

use App\Repositories\Organization\OrganizationRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ListOrganizationViewModel extends ViewModel
{
    /**
     * @var OrganizationRepository.
     */
    protected $orgRepo;

    public function __construct(OrganizationRepository $orgRepo, Request $request)
    {
        $this->orgRepo = $orgRepo;
        $this->request = $request;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function orgs(): LengthAwarePaginator
    {
        return $this->orgRepo->model()->with('branchs')->filter($this->request)->paginate(20);
    }
}
