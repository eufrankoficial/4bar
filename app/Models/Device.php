<?php

namespace App\Models;

/**
 * Class Device
 * @package App\Models.
 */
class Device extends BaseModel
{
    /**
     * @var string.
     */
    protected $table = 'device';

    /**
     * @var array.
     */
    protected $fillable = [
        'organization_id',
        'branch_id',
        'name',
        'last_synchronization',
        'slug',
        'created_by',
        'udpated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var array.
     */
    protected $dates = [
        'last_synchronization',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var string.
     */
    protected $source = 'name';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function branchs()
    {
        return $this->belongsTo(BranchDetail::class, 'branch_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function org()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne.
     */
    public function sensor()
    {
        return $this->hasOne(Sensor::class, 'device_id', 'id');
    }
}
