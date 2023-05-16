<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureMeasurement extends Model
{
    /**
     * @var string.
     */
    protected $table = 'temperature_measurement';

    /**
     * @var array.
     */
    protected $fillable = [
        'organization_id',
        'branch_id',
        'device_id',
        'sensor_id',
        'cold_chamber_id',
        'temperature',
        'power_supply',
        'measured_at',
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
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function getTemperatureAttribute()
    {
        return number_format($this->attributes['temperature'], 0, ',', '.');
    }
}
