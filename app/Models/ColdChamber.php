<?php

namespace App\Models;


use App\Traits\Searchable;

class ColdChamber extends BaseModel
{
    use Searchable;

    /**
     * @var string.
     */
    protected $table = 'cold_chamber';

    /**
     * @var array.
     */
    protected $fillable = [
        'name',
        'organization_id',
        'branch_id',
        'sensor_id',
        'status',
        'capacity',
        'temperature',
        'slug',
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

    CONST ATIVO = 'Ativo';
    CONST INATIVO = 'Inativo';

    /**
     * @var string
     */
    protected $keyName = 'slug';

    /**
     * @var string
     */
    protected $source = 'name';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branchs()
    {
        return $this->belongsTo(BranchDetail::class, 'branch_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function sensor()
    {
        return $this->belongsTo(Sensor::class, 'sensor_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function kegs()
    {
        return $this->hasMany(Keg::class, 'cold_chamber_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne.
     */
    public function measureTemperature()
    {
        return $this->hasOne(TemperatureMeasurement::class, 'cold_chamber_id', 'id')->orderBy('id', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function temperatureHistory()
    {
        return $this->hasMany(TemperatureMeasurement::class, 'cold_chamber_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function warnings()
    {
        return $this->hasMany(Warning::class, 'cold_chamber_id', 'id');
    }

    public function getTemperatureViewAttribute()
    {
        return number_format($this->attributes['temperature'], 1, ',', '.');
    }


}
