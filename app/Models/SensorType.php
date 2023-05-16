<?php

namespace App\Models;

/**
 * Class SensorType.
 * @package App\Models.
 */
class SensorType extends BaseModel
{
    /**
     * @var string.
     */
    protected $table = 'sensor_type';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var string.
     */
    protected $source = 'sensor_type_name';

    /**
     * @var array.
     */
    protected $fillable = [
        'sensor_type',
        'sensor_type_name',
        'created_by',
        'updated_by',
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    /**
     * @var array.
     */
    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    
    public function sensors()
    {
        return $this->hasMany(Sensor::class, 'sensor_type_id', 'id');
    }


}
