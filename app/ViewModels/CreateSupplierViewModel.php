<?php

namespace App\ViewModels;

use App\Repositories\Organization\OrganizationRepository;
use App\Repositories\Supplier\SupplierRepository;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\Array_;
use Spatie\ViewModels\ViewModel;

/**
 * Class CreateSupplierViewModel.
 * @package App\ViewModels.
 */
class CreateSupplierViewModel extends ViewModel
{
    /**
     * @var SupplierRepository.
     */
    protected $supRepo;

    /**
     * @var OrganizationRepository.
     */
    protected $orgRepo;

    public function __construct(SupplierRepository $supRepo, OrganizationRepository $orgRepo)
    {
        $this->supRepo = $supRepo;
        $this->orgRepo = $orgRepo;
    }


    /**
     * @return Array.
     */
    public function types(): Array
    {
        return $this->supRepo->model()->getTypes();
    }

    /**
     * @return Collection.
     */
    public function orgs(): Collection
    {
        return $this->orgRepo->all(false, false, ['branchs']);
    }
}
