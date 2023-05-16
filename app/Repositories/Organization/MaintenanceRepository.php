<?php

namespace App\Repositories\Organization;

use App\Models\Maintenance;
use App\Models\Organization;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MaintenanceRepository extends BaseRepository
{
    protected $modelClass = Maintenance::class;


    public function list()
    {
        $builder = $this->model()->with(['tap', 'branchs'])->filter(request());

        $builder = $this->filter($builder, request());

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param Request $request
     * @return Builder|\Illuminate\Database\Query\Builder.
     */
    private function filter(Builder $builder, Request $request)
    {
        if($request->get('type') == Maintenance::COLD_CHAMBER)
            $builder = $builder->whereNotNull('cold_chamber_id');
        elseif($request->get('type') == Maintenance::TAP)
            $builder = $builder->whereNotNull('tap_id');
        elseif($request->get('type') == Maintenance::DEVICE)
            $builder = $builder->whereNotNull('device_id');

        return $builder;
    }
}
