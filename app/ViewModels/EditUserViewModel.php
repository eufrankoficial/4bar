<?php

namespace App\ViewModels;

use App\Models\BranchDetail;
use App\Models\GroupUser;
use App\Models\User;
use App\Repositories\User\UserGroupRepository;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

/**
 * Class EditUserViewModel.
 * @package App\ViewModels.
 */
class EditUserViewModel extends ViewModel
{
    /**
     * @var User.
     */
    protected $user;

    /**
     * @var UserGroupRepository.
     */
    protected $userGroupRepo;

    public function __construct(User $user, UserGroupRepository $userGroupRepo)
    {
        $this->user = $user;
        $this->userGroupRepo = $userGroupRepo;

        $this->user->load(['branchs', 'organization']);
    }

    /**
     * @return User.
     */
    public function user(): User
    {
        return $this->user;
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
     * @return mixed
     */
    public function userBranchs()
    {
        return $this->user->branchs->pluck('id')->toArray();
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
