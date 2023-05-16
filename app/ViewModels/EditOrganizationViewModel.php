<?php

namespace App\ViewModels;

use App\Models\Organization;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;
use App\Models\User;

/**
 * Class EditOrganizationViewModel.
 * @package App\ViewModels.
 */
class EditOrganizationViewModel extends ViewModel
{

    public function __construct(Organization $org)
    {
        $this->org = $org;
    }

    /***
     * @return Collection.
     */
    public function users(): Collection
    {
        return User::get()->pluck('name', 'id');
    }

    /**
     * @return Organization.
     */
    public function organization(): Organization
    {
        return $this->org;
    }
}
