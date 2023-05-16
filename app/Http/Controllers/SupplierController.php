<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Repositories\Supplier\SupplierRepository;
use App\ViewModels\CreateSupplierViewModel;
use App\ViewModels\EditSupplierViewModel;
use App\ViewModels\ListSupplierViewModel;
use Illuminate\Http\Request;
use DB;
use App\Repositories\Organization\OrganizationRepository;
/**
 * Class SupplierController.
 * @package App\Http\Controllers.
 */
class SupplierController extends Controller
{

    /**
     * @var SupplierRepository.
     */
    protected $supplierRepo;

    /**
     * @var OrganizationRepository.
     */
    protected $orgRepo;

    public function __construct(SupplierRepository $supplierRepo, OrganizationRepository $orgRepo)
    {
        $this->supplierRepo = $supplierRepo;
        $this->orgRepo = $orgRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListSupplierViewModel($this->supplierRepo))->view('supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateSupplierViewModel($this->supplierRepo, $this->orgRepo))->view('supplier.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        try {

            DB::beginTransaction();

            $this->supplierRepo->create($request->except('_token'));

            flash(__('Created with success'), 'success');

            DB::commit();

        } catch (\Exception $e) {

            flash(__('Error'), 'danger');
            DB::rollback();
        }

        return redirect()->route('supplier.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return (new EditSupplierViewModel($supplier, $this->orgRepo))->view('supplier.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        try {

            DB::beginTransaction();

            $this->supplierRepo->update($supplier->id, $request->except('_token'));

            flash(__('Updated with success'), 'success');

            DB::commit();

        } catch (\Exception $e) {

            flash(__('Error'), 'danger');
            DB::rollback();
        }

        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        try {

            $supplier->delete();

            flash(__('Deleted with success'), 'success');

            DB::commit();

        } catch (\Exception $e) {
            flash(__('Errror'), 'danger');

            DB::rollback();
        }

        return redirect()->route('supplier.index');
    }
}
