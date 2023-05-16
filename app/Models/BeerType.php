<?php

namespace App\Models;


use App\Traits\Searchable;

class BeerType extends BaseModel
{
    use Searchable;

    /**
     * @var string.
     */
    protected $table = 'beer_type';

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
        'name',
        'status',
        'ibu',
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

    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'name' => 'like',
        'status' => 'in'
    ];

    /**
     * Status approved
     */
    const STATUS_APPROVED = 'Approved';

    /**
     * Pending
     */
    const STATUS_PENDING = 'Pending';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branchs()
    {
        return $this->belongsTo(BranchDetail::class, 'branch_id', 'id');
    }



}
