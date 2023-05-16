<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\GroupRequest;
use App\Models\GroupUser;
use App\Models\Menu;
use App\Repositories\User\PermissionRepository;
use App\Repositories\User\UserGroupRepository;
use App\ViewModels\CreateGroupUserViewModel;
use App\ViewModels\EditGroupUserViewModel;
use App\ViewModels\ListUserGroupViewModel;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

/**
 * Class UserGroupController.
 * @package App\Http\Controllers.
 */
class UserGroupController extends Controller
{

    /**
     * @var UserGroupRepository.
     */
    protected $userGroupRepo;

    /**
     * @var PermissionRepository.
     */
    protected $permissionRepo;

    public function __construct(UserGroupRepository $userGroupRepo, PermissionRepository $permissionRepo)
    {
        $this->userGroupRepo = $userGroupRepo;
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return (new ListUserGroupViewModel($this->userGroupRepo, $request))->view('users.groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateGroupUserViewModel($this->permissionRepo))->view('users.groups.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        try {

            DB::beginTransaction();

            $role = $this->userGroupRepo->create($request->except('_token', 'permission', 'menus'));

            $permission = $request->get('permission') ? $request->get('permission') : [];
            $this->userGroupRepo->syncPermissions($role, $permission);
            $menus = $request->get('menus') ? $request->get('menus') : [];
            $this->userGroupRepo->syncMenus($role, $menus);

            DB::commit();
            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {

            flash('error', 'danger');
            DB::rollback();
        }

        return redirect()->route('users.group.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupUser $group)
    {
        return (new EditGroupUserViewModel($group, $this->permissionRepo))->view('users.groups.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, GroupUser $group)
    {
        try {
            DB::beginTransaction();

            $role = $this->userGroupRepo->update($group->id, $request->except('_token', 'permission', 'menus'));

            $permissions = $request->get('permission') ? $request->get('permission') : [];

            $this->userGroupRepo->syncPermissions($role, $permissions);
            $menus = $request->get('menus') ? $request->get('menus') : [];
            $this->userGroupRepo->syncMenus($role, $menus);

            DB::commit();
            flash(__('Updated with success'), 'success');

        } catch (\Exception $e) {
            dd($e);
            flash('error', 'danger');
            DB::rollback();
        }

        return redirect()->route('users.group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupUser $group)
    {
        try {
            DB::beginTransaction();

            $this->userGroupRepo->delete($group->id);

            flash(__('Deleted with success'), 'success');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }


        return redirect()->route('users.group.index');
    }
}
