<?php

namespace App\ViewModels;

use App\Models\Organization;
use App\Repositories\Supplier\SupplierRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class ListSupplierViewModel extends ViewModel
{

    /**
     * @var SupplierRepository.
     */
    protected $supplierRepo;

    public function __construct(SupplierRepository $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function suppliers(): LengthAwarePaginator
    {
        return $this->supplierRepo->model()->filter(request())->paginate();
    }

    /**
     * @return Collection.
     */
    public function orgs(): Collection
    {
        return Organization::get();
    }
}
