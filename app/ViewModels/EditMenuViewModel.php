<?php

namespace App\ViewModels;

use App\Models\Menu;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class EditMenuViewModel extends ViewModel
{
    /**
     * @var Menu.
     */
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
        $this->menu->load(['parents']);
    }

    /**
     * @return Menu.
     */
    public function menu(): Menu
    {
        return $this->menu;
    }

    /**
     * @return mixed.
     */
    public function parents()
    {
        return $this->menu->parents->pluck('id')->toArray();
    }

    /**
     * @return Collection
     */
    public function menus(): Collection
    {
        return Menu::doesntHave('parents')->get();
    }
}
