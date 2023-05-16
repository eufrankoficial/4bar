<?php

namespace App\ViewModels;

use App\Models\GroupPermission;
use Spatie\ViewModels\ViewModel;

class EditPermissonViewModel extends ViewModel
{
    /**
     * @var GroupPermission.
     */
    protected $permission;

    public function __construct(GroupPermission $permission)
    {
        $this->permission = $permission;
    }

    public function permission(): GroupPermission
    {
        return $this->permission;
    }
}
