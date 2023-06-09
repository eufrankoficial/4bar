<?php

namespace App\Models;

use App\Models\Scopes\BranchOrgScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BaseModel.
 * @package App\Models.
 */
abstract class BaseModel extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $source = 'name';
    protected $keyName = false;

    /**
     * On creating, updating and deleting Model.
     */
    protected static function boot()
    {
        parent::boot();

        if(current_user()) {
            self::creating(function($model) {
                $model->created_by = current_user()->id;
                $model->updated_by = current_user()->id;
            });

            self::updating(function($model) {
                $model->updated_by = current_user()->id;
            });
        }

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
     * @param Builder $builder
     * @return Builder
     * @throws \Exception.
     */
    public function scopeFilter(Builder $builder, $request)
    {
        if($request->query->count() > 0)
            $builder = $this->search($builder, $request);


        if(current_user()->hasRole('SuperAdmin'))
            return $builder;


        $dataFilter = branch();

        if($builder->getModel() instanceof BranchDetail) {
            $builder->where('branch_detail.id', $dataFilter->id);

            if(current_user()->hasRole('Admin')) {
                $builder->orWhere('branch_detail.organization_id', $dataFilter->organization_id);
            }

        } else {
            $builder->whereHas('branchs', function($query) use ($dataFilter) {
                $id = isset($dataFilter->id) ? $dataFilter->id : 0;
                $query->where('branch_detail.id', $id);
            });
        }

        return $builder;
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
