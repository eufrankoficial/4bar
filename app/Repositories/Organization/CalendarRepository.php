<?php

namespace App\Repositories\Organization;

use App\Models\Calendar;
use App\Repositories\BaseRepository;

/**
 * Class BranchDetailRepository.
 * @package App\Repositories\Organization.
 */
class CalendarRepository extends BaseRepository
{
    /**
     * @var BranchDetail.
     */
    protected $modelClass = Calendar::class;
}
