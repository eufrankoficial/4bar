<?php

namespace App\Repositories\Organization;

use App\Models\Keg;
use App\Models\Tap;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class TapRepository
 * @package App\Repositories\Organization.
 */
class TapRepository extends BaseRepository
{
    protected $modelClass = Tap::class;

    public function __construct()
    {
        $this->kegRepo = app(KegRepository::class);
    }

    public function changeKeg(Keg $keg, Tap $tap)
    {
        if(!$tap || $tap->status == Tap::INACTIVE) {
            return false;
        }

        $this->update($tap->id, [
           'keg_id' => $keg->id
        ]);

        return $tap;
    }

    /**
     * @return Collection.
     */
    public function getActiveTaps(): Collection
    {
        return $this->model()
            ->with(
                [
                    'keg.beerType',
                    'keg.warnings'
                ]
            )
            ->filter(request())
            ->where('status', Tap::ACTIVE)
            ->get();
    }

    /**
     * @param Collection $taps
     * @return Collection.
     */
    public function resolveData(Collection $taps): Collection
    {
        return $taps->map(function(&$tap) {
            if($tap->keg) {
                $capacity = $tap->keg ? (int)$tap->keg->capacity : 0;
                $kegInfo = keg_level($capacity, $tap->keg->volume_available);

                $tap->image = $kegInfo['image'];
                $tap->mililiters = $kegInfo['mililiters'];
                $tap->percent = $kegInfo['percent'];
                $tap->keg = $this->kegRepo->getWarning($tap->keg, $kegInfo['percent']);

            } else {
                $tap->image = asset('assets/core/images/barris/0.png');
                $tap->mililiters = 0;
                $tap->percent = 0;
                $tap->keg = null;
            }

            return $tap;
        });
    }
}
