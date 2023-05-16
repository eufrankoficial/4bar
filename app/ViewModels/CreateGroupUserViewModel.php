<?php

namespace App\ViewModels;

use App\Models\Menu;
use App\Repositories\User\PermissionRepository;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class CreateGroupUserViewModel extends ViewModel
{
    /**
     * @var PermissionRepository
     */
    protected $permissionRepo;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * @return Collection.
     */
    public function permissions(): Collection
    {
        return $this->permissionRepo->all(false, false);
    }
    /**
     * @return Collection.
     */
    public function menus(): Collection
    {
        return Menu::where('parent_id', 0)->with('parents')->get();
    }

}
