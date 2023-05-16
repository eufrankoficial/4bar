<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;
use App\Models\User;

class CreateOrganizationViewModel extends ViewModel
{

    public function users(): Collection
    {
        return User::whereHas('group', function ($query) {
            $query->where('slug', 'admin');
        })->get()->pluck('name', 'id');
    }
}
