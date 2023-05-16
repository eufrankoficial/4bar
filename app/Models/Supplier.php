<?php

namespace App\Models;

use App\Traits\Searchable;

/**
 * Class Supplier.
 * @package App\Models.
 */
class Supplier extends BaseModel
{
    use Searchable;

    /**
     * @var string
     */
    protected $table = 'supplier';

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
    protected $types = [
      'Fabricante' => 'Fabricante',
      'Distribuidor' => 'Distribuidor'
    ];

    /**
     * @var array.
     */
    protected $searchableAttrs = [
        'name' => 'like',
        'type' => '=',
        'cpf_cnpj'=> '=',
        'contact' => '=',
        'organization' => [
            'organization.slug' => '='
        ],
        'branchs' => [
            'branchs.slug' => '='
        ]
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'organization_id',
        'branch_id',
        'type',
        'name',
        'address',
        'contact',
        'email',
        'phone',
        'cpf_cnpj',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    public function branchs()
    {
        return $this->belongsTo(BranchDetail::class, 'branch_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function kegs()
    {
        return $this->hasMany(Keg::class, 'supplier_id', 'id');
    }
}
