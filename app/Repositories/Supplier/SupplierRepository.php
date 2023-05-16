<?php

namespace App\Repositories\Supplier;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Repositories\BaseRepository;

class SupplierRepository extends BaseRepository
{
    protected $modelClass = Supplier::class;

}
