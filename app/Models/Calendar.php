<?php

namespace App\Models;

class Calendar extends BaseModel
{
    /**
     * @var string.
     */
    protected $table = 'calendar';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var string.
     */
    protected $source = 'week_day';

    protected $fillable = [
        'week_day',
        'organization_id',
        'branch_id',
        'opening_time',
        'closing_time',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    const WEEk_DAY = [
        'Domingo',
        'Segunda-feira',
        'Terça-feira',
        'Quarta-feira',
        'Quinta-feira',
        'Sexta-feira',
        'Sábado'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function branch()
    {
        return $this->belongsTo(BranchDetail::class, 'branch_id', 'id');
    }



}
