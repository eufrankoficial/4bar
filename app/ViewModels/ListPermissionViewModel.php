<?php

namespace App\ViewModels;

use App\Repositories\User\PermissionRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

/**
 * Class ListPermissionViewModel.
 * @package App\ViewModels.
 */
class ListPermissionViewModel extends ViewModel
{
    /**
     * @var PermissionRepository.
     */
    protected $permissionRepo;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function permissions(): LengthAwarePaginator
    {
        return $this->permissionRepo->model()->filter(request())->paginate();
    }
}
