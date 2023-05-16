<?php

namespace App\ViewModels;

use App\Enuns\SensorEnum;
use App\Models\Sensor;
use App\Repositories\Organization\ColdChamberRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ListColdChamberViewModel extends ViewModel
{
    /**
     * @var ColdChamberRepository.
     */
    protected $coldChamberRepo;

    public function __construct(ColdChamberRepository $coldChamberRepo)
    {
        $this->coldChamberRepo = $coldChamberRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function coldChambers(): LengthAwarePaginator
    {
        return $this->coldChamberRepo->model()->with(['sensor'])->filter(request())->paginate();
    }

    /**
     * @return Collection.
     */
    public function sensors(): Collection
    {
        $sensors = Sensor::with(['device', 'type']);

        if(branch()) {
            $sensors = $sensors->whereHas('device', function($query) {
                $query->where('branch_id', branch()->id);
            });
        }

        $sensors = $sensors->whereDoesntHave('coldChambers');

        return $sensors
            ->where('sensor_type_id', '=', SensorEnum::TEMPERATURE)
            ->get();
    }
}
