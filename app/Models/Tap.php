<?php

namespace App\Models;

use App\Traits\Searchable;

/**
 * Class Tap.
 * @package App\Models.
 */
class Tap extends BaseModel
{
    use Searchable;

    /**
     * @var string.
     */
    protected $table = 'tap';

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
    protected $fillable = [
        'organization_id',
        'branch_id',
        'keg_id',
        'sensor_id',
        'status',
        'name',
        'status',
        'slug',
        'created_by',
        'updated_by',
        'created_at',
        'udpated_at',
        'deleted_at'
    ];

    /**
     * @var array.
     */
    protected $dates = [
        'created_at',
        'udpated_at',
        'deleted_at'
    ];

    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'name' => 'like',
        'keg' => [
            'keg.ping_keg' => '='
        ],
        'organization_id' => '=',
        'branch_id' => '='
    ];


    const ACTIVE = 'Ativo';
    const INACTIVE = 'Inativo';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function keg()
    {
        return $this->belongsTo(Keg::class, 'keg_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function branchs()
    {
        return $this->belongsTo(BranchDetail::class, 'branch_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne.
     */
    public function flowMeasure()
    {
        return $this->hasOne(FlowMeasurement::class, 'tap_id', 'id')->orderBy('flow_measurement.created_at', 'desc');
    }

    /**
     * @return array.
     */
    public function getLevelAttribute(): array
    {
        $hasMeasure = $this->flowMeasure ? true : false;
        return keg_level((int)$this->keg->capacity, ($hasMeasure ? $this->flowMeasure->mililiters : 0), $hasMeasure);
    }

}
