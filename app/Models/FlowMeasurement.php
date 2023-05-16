<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FlowMeasurement extends Model
{
    /**
     * @var string.
     */
    protected $table = 'flow_measurement';

    /**
     * @var array.
     */
    protected $fillable = [
        'organization_id',
        'branch_id',
        'device_id',
        'device_id',
        'sensor_id',
        'tap_id',
        'keg_id',
        'pulse',
        'mililiters',
        'power_supply',
        'started_at',
        'finished_at',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var array.
     */
    protected $dates = [
        'started_at',
        'finished_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne.
     */
    public function keg()
    {
        return $this->hasOne(Keg::class, 'keg_id', 'id');
    }

    /**
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return Carbon::createFromTimestamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }
}
