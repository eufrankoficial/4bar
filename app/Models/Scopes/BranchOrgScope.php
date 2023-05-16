<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BranchOrgScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
//        if(current_user()->hasRole('SuperAdmin'))
//            return $builder;
//
//        if(cache()->get('current_branch')) {
//
//            $dataFilter = cache()->get('current_branch');
//
//            $builder->whereHas('branchs', function($query) use ($dataFilter) {
//
//                $query->where('branch_id', $dataFilter->id);
//            });
//
//        } elseif(!empty(current_user()->organization)) {
//
//            $builder->whereHas('branchs', function($query) {
//                $query->where('organization_id', current_user()->organization->id);
//            });
//        }
    }
}
