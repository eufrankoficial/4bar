<?php

namespace App\Repositories\Config;

use App\Models\Menu;
use App\Repositories\BaseRepository;

/**
 * Class MenuRepository.
 * @package App\Repositories\Config.
 */
class MenuRepository extends BaseRepository
{

    /**
     * @var string.
     */
    protected $modelClass = Menu::class;

    /**
     * @param Menu $menu.
     * @param $parents.
     */
    public function saveParents(Menu $menu, $parents)
    {
        $parents = $this->whereIn('slug', $parents)->get();

        $parents->map(function($parent) use ($menu) {
            $parent->parent_id = $menu->id;
            $parent->save();
        });
    }
}
