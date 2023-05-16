<?php

namespace App\ViewModels;

use App\Models\Maintenance;
use Spatie\ViewModels\ViewModel;

class ViewMaintenanceViewModel extends ViewModel
{
    /**
     * @var Maintenance.
     */
    protected $maintenance;

    public function __construct(Maintenance $maintenance)
    {
        $this->maintenance = $maintenance;
        $this->maintenance->load(['coldChamber', 'tap', 'device']);
    }

    public function maintenance(): Maintenance
    {
        return $this->maintenance;
    }
}
