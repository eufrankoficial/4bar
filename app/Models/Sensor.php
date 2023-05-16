<?php

namespace App\Models;

/**
 * Class Sensor.
 * @package App\Models.
 */
class Sensor extends BaseModel
{
    /**
     * @var string.
     */
    protected $table = 'sensor';

    /**
     * @var array.
     */
    protected $fillable = [
        'device_id',
        'sensor_type_id',
        'name',
        'flow_rate',
        'status',
        'device_port',
        'stop_pouring_delay',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'slug'
    ];

    /**
     * @var array.
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var bool
     */
    protected $source = 'name';

    /**
     * @var bool
     */
    protected $keyName = 'slug';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function type()
    {
        return $this->belongsTo(SensorType::class, 'sensor_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function coldChambers()
    {
        return $this->hasOne(ColdChamber::class, 'sensor_id','id');
    }

    /***
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tap()
    {
        return $this->hasOne(Tap::class, 'sensor_id', 'id');
    }

    /**
     * @param $value.
     */
    public function setFlowRateAttribute($value)
    {
        if(!empty($value))
            $this->attributes['flow_rate'] = str_replace(',', '.', $value);
    }

    /**
     * @return string|string[].
     */
    public function getFlowRateAttribute()
    {
        if(!empty( $this->attributes['flow_rate']))
            return str_replace('.', ',', $this->attributes['flow_rate']);

        return  $this->attributes['flow_rate'];
    }


}
