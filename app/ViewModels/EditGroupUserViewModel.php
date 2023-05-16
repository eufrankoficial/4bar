<?php

namespace App\ViewModels;

use App\Models\GroupUser;
use App\Models\Menu;
use App\Repositories\User\PermissionRepository;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class EditGroupUserViewModel extends ViewModel
{
    /**
     * @var Role.
     */
    protected $userGroup;

    /**
     * @var PermissionRepository.
     */
    protected $permissionRepo;

    public function __construct(GroupUser $userGroup, PermissionRepository $permissionRepo)
    {
        $this->userGroup = $userGroup;
        $this->userGroup->load(['permissions', 'menus']);
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * @return Role.
     */
    public function group(): Role
    {
        return $this->userGroup;
    }

    /**
     * @return Collection.
     */
    public function menus(): Collection
    {
        return Menu::where('parent_id', 0)->with('parents')->get();
    }

    /**
     * @return mixed
     */
    public function groupPermissions()
    {
        return $this->userGroup->permissions->pluck('name')->toArray();
    }

    public function menusGroup()
    {
        return $this->userGroup->menus->pluck('id')->toArray();
    }

    /**
     * @return Collection
     */
    public function permissions(): Collection
    {
        return $this->permissionRepo->all(false, false);
    }
}
