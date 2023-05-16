<?php

namespace App\Repositories\Organization;

use App\Models\Organization;
use App\Models\PinKegBranch;
use App\Repositories\BaseRepository;
use App\Traits\Searchable;

class PinKegBranchRepository extends BaseRepository
{
    use Searchable;

    protected $modelClass = PinKegBranch::class;
}
