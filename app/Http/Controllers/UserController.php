<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RequestUser;
use App\Models\User;
use App\Repositories\User\UserGroupRepository;
use App\Repositories\User\UserRepository;
use App\ViewModels\CreateUserViewModel;
use App\ViewModels\EditUserViewModel;
use App\ViewModels\ListUserViewModel;
use DB;
use Illuminate\Http\Request;

/**
 * Class UserController.
 * @package App\Http\Controllers.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository.
     */
    protected $userRepo;

    /**
     * @var UserGroupRepository.
     */
    protected $userGroupRepo;

    public function __construct(UserRepository $userRepo, UserGroupRepository $userGroupRepo)
    {
        $this->userRepo = $userRepo;
        $this->userGroupRepo = $userGroupRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return (new ListUserViewModel($this->userRepo, $request))->view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateUserViewModel($this->userGroupRepo))->view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUser $request)
    {
        try {

            DB::beginTransaction();

            $user = $this->userRepo->save($request);
            $this->userRepo->syncRoles($user, $request->get('role'));

            flash(__('Created with success'), 'success');
            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return (new EditUserViewModel($user, $this->userGroupRepo))->view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUser $request, User $user)
    {
        try {

            DB::beginTransaction();

            $user = $this->userRepo->save($request, $user->id);
            $this->userRepo->syncRoles($user, $request->get('role'));

            flash(__('Updated with success'), 'success');
            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $this->userRepo->delete($user->id);

            flash(__('Deleted with success'), 'success');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('users.index');
    }
}
