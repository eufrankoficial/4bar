<?php

namespace App\Models;


use App\Traits\Searchable;

class Maintenance extends BaseModel
{
    use Searchable;

    /**
     * @var string.
     */
    protected $table = 'maintenance';

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
        'device_id',
        'cold_chamber_id',
        'tap_id',
        'name',
        'description',
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
    protected $searchableAttrs = [
        'name' => 'like',
        'organization' => [
            'organization.slug' => '='
        ],
        'branchs' => [
            'branchs.slug' => '='
        ],
    ];

    /**
     * @var array.
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $types = [
        1 => 'Câmara fria',
        2 => 'Torneira',
        3 => 'Dispositivo'
    ];

    CONST COLD_CHAMBER = 1;
    CONST TAP = 2;
    CONST DEVICE = 3;

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
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function coldChamber()
    {
        return $this->belongsTo(ColdChamber::class, 'cold_chamber_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function tap()
    {
        return $this->belongsTo(Tap::class, 'tap_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id', 'id');
    }
}
