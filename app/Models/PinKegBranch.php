<?php

namespace App\Models;

use App\Traits\Searchable;

class PinKegBranch extends BaseModel
{
    use Searchable;
    /**
     * @var string.
     */
    protected $table = 'pin_keg_branch';

    /**
     * @var array.
     */
    protected $fillable = [
        'organization_id',
        'branch_id',
        'pin',
        'used',
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
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var string.
     */
    protected $source = 'pin';

    const USED = 1;
    const NOT_USED = 0;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function keg()
    {
        return $this->belongsTo(Keg::class, 'pin', 'pin_keg');
    }
}
