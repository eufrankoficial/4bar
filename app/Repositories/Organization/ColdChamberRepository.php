<?php

namespace App\Repositories\Organization;

use App\Models\Calendar;
use App\Models\ColdChamber;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

/**
 * Class BranchDetailRepository.
 * @package App\Repositories\Organization.
 */
class ColdChamberRepository extends BaseRepository
{
    /**
     * @var ColdChamber.
     */
    protected $modelClass = ColdChamber::class;


    /**
     * @return Collection
     */
    public function coldChambersActives(): Collection
    {
        return $this->model()->filter(request())
            ->with(
                [
                    'kegs',
                    'warnings'
                ]
            )
            ->where('status', ColdChamber::ATIVO)
            ->orderBy('temperature', 'desc')
            ->get();
    }


    public function getConfigsOfColdChambers(Collection $coldChambers): Collection
    {
        $coldChambers->map(function(&$coldChamber) {
            $image = 'normal_temperature.png';
            $class = 'text-success';
            if($coldChamber->warnings) {
                $coldChamber->warnings->map( function ($warning) use (&$coldChamber, &$image, &$class) {


                    if((float)$coldChamber->temperature < (float)$warning->value_from) {
                        $image = 'cold_temperature.png';
                        $class = 'text-info';
                    } elseif((float)$coldChamber->temperature > (float)$warning->value_to) {
                        $image = 'hot_temperature.png';
                        $class = 'text-danger';
                    }
                });
            }

            $coldChamber->image_temperature = asset('assets/core/images/' .  $image);
            $coldChamber->class = $class;
        });

        return $coldChambers;
    }
}
