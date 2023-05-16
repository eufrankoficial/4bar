<?php

namespace App\ViewModels;

use App\Models\Maintenance;
use App\Repositories\Organization\MaintenanceRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ListMaintenanceViewModel extends ViewModel
{
    /**
     * @var MaintenanceRepository.
     */
    protected $maintenanceRepo;

    public function __construct(MaintenanceRepository $maintenanceRepo)
    {
        $this->maintenanceRepo = $maintenanceRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function maintenence(): LengthAwarePaginator
    {
        return $this->maintenanceRepo->list()->paginate();
    }

    /**
     * @return array.
     */
    public function types(): array
    {
        return Maintenance::$types;
    }
}
