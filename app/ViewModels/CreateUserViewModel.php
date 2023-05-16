<?php

namespace App\ViewModels;

use App\Models\BranchDetail;
use App\Models\GroupUser;
use App\Repositories\User\UserGroupRepository;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

/**
 * Class CreateUserViewModel.
 * @package App\ViewModels.
 */
class CreateUserViewModel extends ViewModel
{
    /**
     * @var UserGroupRepository.
     */
    protected $userGroupRepo;

    public function __construct(UserGroupRepository $userGroupRepo)
    {
        $this->userGroupRepo = $userGroupRepo;
    }

    /**
     * @return Collection.
     */
    public function groups(): Collection
    {
        $query = $this->userGroupRepo->model();

        if(!current_user()->hasRole('SuperAdmin')) {
            $query = $query->whereNotIn('id', [GroupUser::SUPER_ADMIN]);
        }

        return $query->get();
    }

    /**
     * @return Collection
     */
    public function branchs(): Collection
    {
        $query = BranchDetail::query();
        if(current_user()->organization)
            $query = BranchDetail::byOrg(current_user()->organization);

        return $query->get()->pluck('name', 'id');
    }
}
