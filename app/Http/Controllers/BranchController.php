<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organizations\BranchRequestPost;
use App\Models\BranchDetail;
use App\Models\Organization;
use App\Repositories\Organization\BranchDetailRepository;
use App\ViewModels\CreateBranchViewModel;
use App\ViewModels\EditBranchViewModel;
use App\ViewModels\ListBranchsOrganizationViewModel;
use DB;

/**
 * Class BranchController
 * @package App\Http\Controllers
 */
class BranchController extends Controller
{

    /**
     * @var BranchDetailRepository.
     */
    protected $branchRepo;

    public function __construct(BranchDetailRepository $branchRepo)
    {
        $this->branchRepo = $branchRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Organization $org = null)
    {
        return (new ListBranchsOrganizationViewModel($org, $this->branchRepo))->view('organization.branchs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Organization $org = null)
    {
        return (new CreateBranchViewModel($org))->view('organization.branchs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequestPost $request, Organization $org = null)
    {
        try {
            DB::beginTransaction();

            if(!$request->get('organization_id') && !is_null($org))
                $request->merge(['organization_id' => $org->id]);

            $this->branchRepo->save($request);

            DB::commit();

            flash(__('Created with sucess'), 'success');

        } catch (\Exception $e) {
            dd($e);
            flash(__('Error'), 'danger');

            DB::rollback();
        }

        return !is_null($org) ? redirect()->route('orgs.branchs.index', $org->slug) : redirect()->route('branchs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $org, BranchDetail $branch)
    {
        return (new EditBranchViewModel($branch))->view('organization.branchs.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequestPost $request, Organization $org, BranchDetail $branch)
    {
        try {
            DB::beginTransaction();

            $request->merge(['organization_id' => $org->id]);

            $this->branchRepo->save($request, $branch);

            flash(__('Updated with sucess'), 'success');

            DB::commit();

        } catch (\Exception $e) {

            flash(__('Error'), 'danger');

            DB::rollback();
        }

        return redirect()->route('orgs.branchs.index', $org->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $org, BranchDetail $branch)
    {
        try {

            DB::beginTransaction();

            $this->branchRepo->delete($branch->id);

            flash(__('Deleted with success'), 'success');

            DB::commit();

        } catch (\Exception $e) {
            flash(__('Error'), 'danger');

            DB::rollback();
        }

        return redirect()->route('orgs.branchs.index', $org->slug);
    }
}
