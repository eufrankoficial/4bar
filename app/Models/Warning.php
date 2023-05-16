<?php

namespace App\Models;

class Warning extends BaseModel
{
    /**
     * @var string.
     */
    protected $table = 'warning';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var string.
     */
    protected $source = 'name';

    /**
     * @var array.
     */
    protected $fillable = [
        'organization_id',
        'branch_id',
        'keg_id',
        'cold_chamber_id',
        'name',
        'type',
        'value_from',
        'value_to',
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

    /**
     * @var array
     */
    public static $types = [
        'Camara Fria',
        'Barril'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function org()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

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
    public function keg()
    {
        return $this->belongsTo(Keg::class, 'keg_id', 'id');
    }
}
