<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository.
 * @package App\Repositories\User.
 */
class UserRepository extends BaseRepository
{
    /**
     * @var User.
     */
    protected $modelClass = User::class;

    /**
     * Save a user.
     * @param $request.
     * @param null $id.
     * @return \App\Repositories\Model.
     */
    public function save($request, $id = null)
    {

        if(!is_null($id)) {
            $data = $request->except('_token', 'role', 'branchs');

            if($data['password'] === null)
                unset($data['password']);

            $data['password'] = bcrypt($data['password']);

            $user = $this->update($id, $data);

        } else {
            $user = $this->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ]);
        }

        $branchs = $request->get('branchs');

        $this->detach($user, 'branchs', $branchs);

        return $user;
    }

    /**
     * @param User $user
     * @param array $role
     * @return User.
     */
    public function syncRoles(User $user, array $role)
    {
        $user->syncRoles($role);

        return $user;
    }
}
