<?php

namespace App\ViewModels;

use App\Models\Supplier;
use App\Repositories\Organization\OrganizationRepository;
use App\Repositories\Supplier\SupplierRepository;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class EditSupplierViewModel extends ViewModel
{
    /**
     * @var SupplierRepository.
     */
    protected $supplier;

    /**
     * @var OrganizationRepository.
     */
    protected $orgRepo;

    public function __construct(Supplier $supplier, OrganizationRepository $orgRepo)
    {
        $this->supplier = $supplier;
        $this->orgRepo = $orgRepo;
    }

    /**
     * @return Array.
     */
    public function types(): Array
    {
        return $this->supplier->getTypes();
    }

    /**
     * @return Supplier.
     */
    public function supplier(): Supplier
    {
        return $this->supplier;
    }

    /**
     * @return Collection.
     */
    public function orgs(): Collection
    {
        return $this->orgRepo->all(false, false, ['branchs']);
    }

}
