<?php

namespace App\ViewModels;

use App\Models\Device;
use App\Models\Organization;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class EditDeviceViewModel extends ViewModel
{
    /**
     * @var Device.
     */
    protected $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    /**
     * @return Device.
     */
    public function device(): Device
    {
        return $this->device;
    }

    /**
     * @return Collection.
     */
    public function orgs(): Collection
    {
        return Organization::with(['branchs'])->get();
    }
}
