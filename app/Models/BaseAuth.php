<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class BaseAuth.
 * @package App\Models.
 */
abstract class BaseAuth extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use Sluggable;

    /**
     * @var string.
     */
    protected $guard_name = 'web';

    /**
     * @var string.
     */
    protected $table = 'user';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var string.
     */
    protected $source = 'name';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return bool|string.
     */
    public function getRouteKeyName()
    {
        if(!$this->keyName)
            return parent::getRouteKeyName(); // TODO: Change the autogenerated stub

        return $this->keyName;
    }

    /**
     * @param Builder $builder
     * @param $slug
     * @return Builder.
     */
    public function scopeSlug(Builder $builder, $slug)
    {
        return $builder->where('slug', $slug);
    }

    /**
     * @return array.
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' =>  $this->source
            ]
        ];
    }

    /**
     * @param Builder $builder
     * @return Builder
     * @throws \Exception
     */
    public function scopeFilter(Builder $builder, Request $request)
    {
        if($request->query->count() > 0) {
            $builder = $this->search($builder, $request);
        }

        if(current_user()->hasRole('SuperAdmin'))
            return $builder;

//        if(current_user()->organization) {
//            return $builder->whereHas('branchs', function($query) {
//                $query->where('organization_id', current_user()->organization->id);
//            });
//
//        } elseif

        if(cache()->get('current_branch')) {

            $dataFilter = cache()->get('current_branch');

            return $builder->whereHas('branchs', function($query) use ($dataFilter) {
                $query->where('branch_id', $dataFilter->id);
            });
        }
    }

    /**
     * @param $value.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}