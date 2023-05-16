<?php

namespace App\ViewModels;

use App\Models\Organization;
use App\Repositories\Organization\BranchDetailRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ListBranchsOrganizationViewModel extends ViewModel
{
    /**
     * @var Organization.
     */
    protected $org;

    public function __construct(Organization $org = null, BranchDetailRepository $branchRepo = null)
    {
        $this->org = $org;
        $this->branchRepo = $branchRepo;
        if(!is_null($this->org))
            $this->org->load('branchs');
    }

    /**
     * @return Organization.
     */
    public function org()
    {
        if(current_user()->organization)
            return current_user()->organization;

        return !is_null($this->org) ? $this->org : null;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function branchs(): LengthAwarePaginator
    {
        if(!is_null($this->org))
            return $this->org->branchs()->filter(request())->paginate();


        return $this->branchRepo->model()->with(['org'])->filter(request())->paginate();
    }

    /**
     * @return Collection.
     */
    public function orgs(): Collection
    {
        return Organization::get();
    }

}
