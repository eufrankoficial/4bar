<?php

namespace App\ViewModels;

use App\Repositories\Config\MenuRepository;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class CreateMenuViewModel extends ViewModel
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
     * @return Collection.
     */
    public function menus(): Collection
    {
        return $this->menuRepo->get();
    }
}
