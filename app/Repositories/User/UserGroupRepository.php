<?php

namespace App\Repositories\User;

use App\Models\GroupUser;
use App\Models\Menu;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class UserGroupRepository.
 * @package App\Repositories\User.
 */
class UserGroupRepository extends BaseRepository
{
    /**
     * @var Spatie\Permission\Models\Role.
     */
    protected $modelClass = GroupUser::class;


    public function search(Request $request)
    {
        $model = $this->model()->search($request);
    }

    /**
     * Sync permissions to role.
     * @param Role $role
     * @param array $permissions
     * @return Role
     */
    public function syncPermissions(GroupUser $role, array $permissions)
    {
        $role->syncPermissions($permissions);

        return $role;
    }

    /**
     * Sync a group user.
     * @param GroupUser $role
     * @param array $menus
     * @return array
     */
    public function syncMenus(GroupUser $role, array $menus)
    {
        return $role->menus()->sync($menus);
    }

}
