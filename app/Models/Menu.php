<?php

namespace App\Models;

use App\Traits\Searchable;

/**
 * Class Menu.
 * @package App\Models.
 */
class Menu extends BaseModel
{
    use Searchable;

    /**
     * @var string.
     */
    protected $table = 'menu';

    /**
     * @var string.
     */
    protected $source = 'menu';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var array.
     */
    protected $fillable = [
        'order',
        'parent_id',
        'menu',
        'icon',
        'route',
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
        'menu' => 'like',
        'parent_id' => '='
    ];


    public function roles()
    {
        return $this->belongsToMany(GroupUser::class, 'menu_role', 'menu_id', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function parents()
    {
        return $this->hasMany($this, 'parent_id', 'id');
    }
}
