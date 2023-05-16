<?php

namespace App\Repositories\Organization;

use App\Models\Organization;
use App\Models\PinKegBranch;
use App\Models\Warning;
use App\Repositories\BaseRepository;

class WarningRepository extends BaseRepository
{
    protected $modelClass = Warning::class;
}
