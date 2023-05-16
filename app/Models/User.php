<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Traits\Searchable;

/**
 * Class User.
 * @package App\Models.
 */
class User extends BaseAuth
{
    use Searchable;

    /**
     * @var string.
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', ''
    ];

    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'name' => 'like',
        'email' => 'like',
        'group' => [
            'group.slug' => '='
        ],
        'organization' => [
            'organization.slug' => '='
        ],
        'branchs' => [
            'branchs.slug' => '='
        ]
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany.
     */
    public function group()
    {
        return $this->belongsToMany(GroupUser::class, 'model_has_roles', 'model_id', 'role_id');    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany.
     */
    public function branchs()
    {
        return $this->belongsToMany(BranchDetail::class, 'user_branch', 'user_id', 'branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne(Organization::class, 'administrator_id', 'id');
    }

    /**
     * @param $permission.
     */
    public function hasPermission($permission)
    {
        if($this->isSuperAdmin())
            return true;

        $route = get_current_route();

        $role = $this->group()->with('menus')->whereHas('menus', function($query) use ($route) {
            $query->where('route', $route);
        })->first();

        if(is_null($role))
            return false;

        $permissions = $role->permissions->pluck('name')->toArray();

        $collectPermission = collect($permission);

        $hasPermission = $collectPermission->filter(function($perm) use ($permissions) {
            return in_array($perm, $permissions);
        });

        return $hasPermission->count() > 0;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function userHasPermission($permission)
    {
        if($this->isSuperAdmin())
            return true;

        $roles = $this->group()->with('permissions')->whereHas('permissions', function($query) use ($permission) {
            $query->whereIn('name', $permission);
        })->get();

        $permis = collect([]);
        $roles->map(function($role) use ($permis){
            $role->permissions->map(function($perm) use ($permis){
                $permis[] = $perm->name;
            });
        });

        $hasPermission = $permis->filter(function($perm) use ($permission) {
            return in_array($perm, $permission);
        });

        return $hasPermission->count() > 0;
    }

    /**
     * @param $route
     * @return bool
     */
    public function hasPermissionRoute($route)
    {
        if($this->isSuperAdmin())
            return true;

        $role = $this->group()->with('menus')->whereHas('menus', function($query) use ($route) {
            $query->where('route', $route);
        })->first();

        if(is_null($role))
            return false;

        $menus = $role->menus->pluck('route')->toArray();

        return in_array($route, $menus);
    }

    /**
     * @return mixed.
     */
    public function isSuperAdmin()
    {
        return current_user()->hasRole('SuperAdmin');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->email));
    }



}
