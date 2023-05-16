<?php

namespace App\ViewModels;

use App\Models\Organization;
use App\Repositories\Config\DeviceRepository;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class CreateDeviceViewModel extends ViewModel
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    /**
     * @return Collection.
     */
    public function orgs(): Collection
    {
        return Organization::with(['branchs'])->get();
    }
}
