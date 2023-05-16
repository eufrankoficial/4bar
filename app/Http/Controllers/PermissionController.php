<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\PermissionRequest;
use App\Models\GroupPermission;
use App\Repositories\User\PermissionRepository;
use App\ViewModels\EditPermissonViewModel;
use App\ViewModels\ListPermissionViewModel;
use DB;
use Illuminate\Http\Request;

/**
 * Class PermissionController.
 * @package App\Http\Controllers.
 */
class PermissionController extends Controller
{
    /**
     * @var PermissionRepository.
     */
    protected $permissionRepo;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permissionRepo.
     */
    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return (new ListPermissionViewModel($this->permissionRepo))->view('users.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.permissions.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        try {

            DB::beginTransaction();

            $this->permissionRepo->create($request->except('_token'));

            DB::commit();

            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {
            flash(__('Error'), 'danger');

            DB::rollback();
        }

        return redirect()->route('users.permission.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPermission $permission)
    {
        return (new EditPermissonViewModel($permission))->view('users.permissions.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, GroupPermission $permission)
    {
        try {

            DB::beginTransaction();

            $this->permissionRepo->update($permission->id, $request->except('_token'));

            flash(__('Updated with success'), 'success');

            DB::commit();

        } catch (\Exception $e) {
            flash(__('Error'), 'danger');

            DB::rollback();
        }

        return redirect()->route('users.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupPermission $permission)
    {
        try {
            DB::beginTransaction();

            $this->permissionRepo->delete($permission->id);

            flash(__('Deleted with success'), 'success');

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            flash(__('Error'), 'danger');
        }

        return redirect()->route('users.permission.index');
    }
}
