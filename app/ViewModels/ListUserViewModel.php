<?php

namespace App\ViewModels;

use App\Models\BranchDetail;
use App\Models\GroupUser;
use App\Models\Organization;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ListUserViewModel extends ViewModel
{
    /**
     * @var UserRepository.
     */
    protected $userRepo;

    public function __construct(UserRepository $userRepo, Request $request)
    {
        $this->userRepo = $userRepo;
        $this->request = $request;
    }

    /**
     * @return Collection.
     */
    public function users(): LengthAwarePaginator
    {
        $filter = $this->userRepo->model()->with(['branchs.org', 'group', 'organization'])->filter($this->request);

        return $filter->orderBy('created_at', 'desc')->paginate();
    }

    /**
     * @return mixed.
     */
    public function types()
    {
        $query = GroupUser::query();

        if(!current_user()->hasRole('SuperAdmin')) {
            $query = $query->whereNotIn('id', [GroupUser::SUPER_ADMIN]);
        }

        return $query->get();
    }

    public function orgs()
    {
        return Organization::get();
    }

}
