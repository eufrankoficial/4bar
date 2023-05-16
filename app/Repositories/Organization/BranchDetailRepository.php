<?php

namespace App\Repositories\Organization;

use App\Models\BranchDetail;
use App\Repositories\BaseRepository;

/**
 * Class BranchDetailRepository.
 * @package App\Repositories\Organization.
 */
class BranchDetailRepository extends BaseRepository
{
    /**
     * @var BranchDetail.
     */
    protected $modelClass = BranchDetail::class;

    /**
     * Save a time to branch.
     * @param $request
     * @param BranchDetail|null $branch
     * @return \App\Repositories\Model
     */
    public function save($request, BranchDetail $branch = null)
    {
        if(!is_null($branch))
            $b = $this->update($branch->id, $request->except('_token', 'calendar'));
        else
            $b = $this->create($request->except('_token', 'calendar'));

        if($request->get('calendar')) {
            foreach($request->get('calendar') as $calendar) {
                $calendar['organization_id'] = $request->get('organization_id');
                $day = $b->calendars()->where('week_day', $calendar['week_day'])->first();
                if($day) {
                    $day->update($calendar);
                } else {
                    $b->calendars()->create($calendar);
                }
            }
        }

        return $b;
    }
}
