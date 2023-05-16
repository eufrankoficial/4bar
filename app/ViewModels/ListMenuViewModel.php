<?php

namespace App\ViewModels;

use App\Repositories\Config\MenuRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ListMenuViewModel extends ViewModel
{
    /**
     * @var MenuRepository.
     */
    protected $menuRepo;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function menus(): LengthAwarePaginator
    {
        return $this->menuRepo->model()->with(['parents'])->filter(request())->paginate();
    }

    /**
     * @return Collection.
     */
    public function fathers(): Collection
    {
        return $this->menuRepo->model()->whereHas('parents')->get();
    }
}
