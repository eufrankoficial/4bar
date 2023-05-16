<?php

namespace App\Models;

use App\Traits\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class GroupPermission extends Permission
{
    use Sluggable;
    use Searchable;

    /**
     * @var string.
     */
    protected $source = 'name';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'name' => 'like'
    ];

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

        if(cache()->get('current_branch')) {

            $dataFilter = cache()->get('current_branch');

            return $builder->whereHas('branchs', function($query) use ($dataFilter) {
                $query->where('branch_id', $dataFilter->id);
            });
        } elseif(current_user()->organization) {

            return $builder->whereHas('branchs', function($query) {
                $query->where('organization_id', current_user()->organization->id);
            });
        }
    }

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
}