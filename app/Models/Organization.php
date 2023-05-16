<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Scopes\BranchOrgScope;
use App\Traits\Searchable;

class Organization extends BaseModel
{
    use Searchable;

    /**
     * @var string.
     */
    protected $table = 'organization';

    protected $keyName = 'slug';

    /**
     * @var array.
     */
    protected $fillable = [
        'administrator_id',
        'name',
        'slug',
        'created_by',
        'udpated_by',
        'created_at',
        'updated_at'
    ];

    /**
     * @var array.
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];


    protected $source = 'name';

    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'name' => 'like',
        'administrator' => [
            'administrator.slug' => '='
        ],
    ];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BranchOrgScope);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function branchs()
    {
        return $this->hasMany(BranchDetail::class, 'organization_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function administrator()
    {
        return $this->belongsTo(User::class, 'administrator_id', 'id');
    }


}
