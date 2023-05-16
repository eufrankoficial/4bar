<?php

namespace App\ViewModels;

use App\Models\Menu;
use App\Repositories\User\UserGroupRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Permission;
use Spatie\ViewModels\ViewModel;

/**
 * Class ListUserGroupViewModel.
 * @package App\ViewModels.
 */
class ListUserGroupViewModel extends ViewModel
{
    /**
     * @var UserGroupRepository.
     */
    protected $userGroupRepo;

    protected $request;

    public function __construct(UserGroupRepository $userGroupRepo, Request $request)
    {
        $this->userGroupRepo = $userGroupRepo;
        $this->request = $request;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function groups(): LengthAwarePaginator
    {
        return $this->userGroupRepo->model()->with(['permissions', 'menus'])->filter($this->request)->paginate();
    }

    public function permissions()
    {
        return Permission::get();
    }

    public function menus()
    {
        return Menu::with('parents')->where('parent_id', 0)->get();
    }
}
