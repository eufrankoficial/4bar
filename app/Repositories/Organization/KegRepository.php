<?php

namespace App\Repositories\Organization;

use App\Models\Keg;
use App\Models\Tap;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class KegRepository extends BaseRepository
{
    protected $modelClass = Keg::class;

    public function getKeg($pin)
    {
        $keg = $this->model()->where('pin_keg', '=', $pin)->with(['taps'])->filter(request())->first();
        if(!$keg)
            return false;


        $data['keg'] = $keg;

        if($keg->taps) {
            $data['taps'] = $keg->taps;
        }

        return $data;

    }

    public function kegs(): Collection
    {
        $kegs = $this->model();
        $kegs = $kegs->with(['org', 'branchs', 'beerType', 'taps.flowMeasure', 'warnings', 'coldChamber']);
        $kegs = $kegs->whereDoesntHave('taps');

        return $kegs->filter(request())
                ->where('status', '!=', Keg::COLLECTED)
                ->orderBy('created_at', 'desc')
                ->get();
    }

    public function getWarning(Keg &$keg, $percent)
    {
        $keg->send_warning = false;

        $keg->warnings->map(function($warning) use (&$keg, $percent){
            $keg->send_warning = (100 - (float)$percent) <= $warning->value_from;
        });

        return $keg;
    }
}
