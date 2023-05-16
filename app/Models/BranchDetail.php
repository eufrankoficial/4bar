<?php

namespace App\Models;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BranchDetail
 * @package App\Models.
 */
class BranchDetail extends BaseModel
{

    use Searchable;

    /**
     * @var string.
     */
    protected $table = 'branch_detail';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    protected $fillable = [
        'organization_id',
        'name',
        'phone',
        'address',
        'number_of_employees',
        'cnpj',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $perPage = 15;

    /**
     * @var array
     */
    protected $searchableAttrs = [
        'name' => 'like',
        'address' => 'like',
        'org' => [
            'org.slug' => '='
        ]
    ];

    const SUPER_ADM_BAR = 3;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function org()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function calendars()
    {
        return $this->hasMany(Calendar::class, 'branch_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function pins()
    {
        return $this->hasMany(PinKegBranch::class, 'branch_id', 'id');
    }

    /**
     * @param Builder $builder
     * @param $orgId
     * @return mixed.
     */
    public function scopeByOrg(Builder $builder, Organization $org)
    {
        if(!is_null($org))
            return $builder->where('organization_id', $org->id);

        return $builder;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany.
     */
    public function beerTypes()
    {
        return $this->belongsToMany(BeerType::class, 'branch_beer_type', 'branch_id', 'beer_type_id');
    }

    /**
     * @param BranchDetail $branch
     * @return bool.
     */
    public function canDelete($branch)
    {
        $canDelete = false;

        if(!$branch->calendars && !$branch->pins)
            $canDelete = true;

        return $canDelete;
    }

}
