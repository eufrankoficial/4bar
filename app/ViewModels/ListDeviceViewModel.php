<?php

namespace App\ViewModels;

use App\Repositories\Config\DeviceRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

/**
 * Class ListDeviceViewModel.
 * @package App\ViewModels.
 */
class ListDeviceViewModel extends ViewModel
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
     * @return LengthAwarePaginator.
     */
    public function devices(): LengthAwarePaginator
    {
        return $this->deviceRepo->model()->with(['org', 'branchs'])->filter(request())->paginate();
    }
}
