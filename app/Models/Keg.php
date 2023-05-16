<?php

namespace App\Models;

use Carbon\Carbon;

class Keg extends BaseModel
{
    /**
     * @var string.
     */
    protected $table = 'keg';

    /**
     * @var string.
     */
    protected $keyName = 'slug';

    /**
     * @var string.
     */
    protected $source = 'pin_keg';

    /**
     * @var array.
     */
    protected $fillable = [
        'organization_id',
        'branch_id',
        'supplier_id',
        'beer_type_id',
        'inbound_datetime',
        'cold_chamber_id',
        'outbound_datetime',
        'outbound_name',
        'due_date',
        'name',
        'pin_keg',
        'volume_available',
        'status',
        'capacity',
        'slug',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_synchronization'
    ];

    /**
     * @var array.
     */
    protected $dates = [
        'outbound_datetime',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_synchronization'
    ];

    const STATUS = [
        'Full', 'Half', 'Empty'
    ];

    const FULL = 'Full';
    const COLLECTED = 'Collected';
    const HALF = 'Half';
    const EMPTY = 'Empty';

    const DAYS_TO_DUE_DATE = 5;

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
    public function beerType()
    {
        return $this->belongsTo(BeerType::class, 'beer_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function warnings()
    {
        return $this->hasMany(Warning::class, 'keg_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany.
     */
    public function taps()
    {
        return $this->hasOne(Tap::class, 'keg_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
     */
    public function coldChamber()
    {
        return $this->belongsTo(ColdChamber::class, 'cold_chamber_id', 'id');
    }

    /**
     * @return string
     */
    public function getDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])->format('d/m/Y');
    }

    /**
     * @return string.
     */
    public function getInboundDatetimeAttribute()
    {
        return Carbon::createFromTimestamp(strtotime($this->attributes['inbound_datetime']))->format('d/m/Y');
    }

    /**
     * @return string.
     */
    public function getlastSynchronizationAttribute()
    {
        return Carbon::createFromTimestamp(strtotime($this->attributes['last_synchronization']))->diffForHumans();
    }

    /**
     * @return string.
     */
    public function getOutboundDatetimeAttribute()
    {
        if(!empty($this->attributes['outbound_datetime']))
            return Carbon::createFromTimestamp(strtotime($this->attributes['outbound_datetime']))->format('d/m/Y');
    }

    /**
     * @param $value.
     */
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::createFromFormat('d-m-Y', str_replace('/', '-', $value))->format('Y-m-d');
    }

    /**
     * @param $value.
     */
    public function setInboundDatetimeAttribute($value)
    {
        $this->attributes['inbound_datetime'] = Carbon::createFromFormat('d-m-Y', str_replace('/', '-', $value))->format('Y-m-d');
    }

    /**
     * @param $value.
     */
    public function setOutboundDatetimeAttribute($value)
    {
        if($value)
            $this->attributes['outbound_datetime'] = Carbon::createFromFormat('d-m-Y', str_replace('/', '-', $value))->format('Y-m-d');
    }

    /**
     * @return bool.
     */
    public function getNearDueDateAttribute(): bool
    {
        $dueDate = Carbon::createFromFormat('Y-m-d', $this->attributes['due_date']);
        $today = now();
        $daysToDueDate = $dueDate->diffInDays($today);

        if($daysToDueDate > self::DAYS_TO_DUE_DATE) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function getUsedAttribute(): bool
    {
        return $this->volume_available > 0 && $this->volume_available < $this->capacity;
    }

    /**
     * @return bool.
     */
    public function getEmptyAttribute(): bool
    {
        return $this->volume_available  <= 0;
    }

    /**
     * @return int.
     */
    public function getCapacityViewAttribute()
    {
        return str_replace('.', ',', $this->attributes['capacity']);
    }

    public function getVolumeAvailableViewAttribute()
    {
        return str_replace('.', ',', $this->attributes['volume_available']);
    }

    public function setCapacityAttribute($value)
    {
        $this->attributes['capacity'] = str_replace(',', '.', $value);
    }

    public function setVolumeAvailableAttribute($value)
    {
        $this->attributes['volume_available'] = str_replace(',', '.', $value);
    }
}
