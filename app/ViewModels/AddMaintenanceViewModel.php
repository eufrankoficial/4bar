<?php

namespace App\ViewModels;

use App\Models\ColdChamber;
use App\Models\Maintenance;
use App\Models\Tap;
use App\Repositories\Config\DeviceRepository;
use App\Repositories\Organization\ColdChamberRepository;
use App\Repositories\Organization\MaintenanceRepository;
use App\Repositories\Organization\TapRepository;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class AddMaintenanceViewModel extends ViewModel
{
    /**
     * @var MaintenanceRepository.
     */
    protected $maintenanceRepo;

    public function __construct(MaintenanceRepository $maintenanceRepo)
    {
        $this->maintenanceRepo = $maintenanceRepo;
        $this->tapRepo = app(TapRepository::class);
        $this->coldChamber = app(ColdChamberRepository::class);
        $this->deviceRepo = app(DeviceRepository::class);
    }


    /**
     * @return Collection.
     */
    public function taps(): Collection
    {
        return $this->tapRepo->model()->filter(request())->get();
    }

    /**
     * @return Collection.
     */
    public function coldChambers(): Collection
    {
        return $this->coldChamber->model()->filter(request())->get();
    }

    /**
     * @return Collection.
     */
    public function devices(): Collection
    {
        return $this->deviceRepo->model()->filter(request())->get();
    }

    /**
     * @return array.
     */
    public function types(): array
    {
        return Maintenance::$types;
    }
}
