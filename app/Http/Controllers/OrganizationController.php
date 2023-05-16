<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organizations\OrgRequest;
use App\Models\Organization;
use App\Repositories\Organization\OrganizationRepository;
use App\ViewModels\CreateOrganizationViewModel;
use App\ViewModels\EditOrganizationViewModel;
use App\ViewModels\ListOrganizationViewModel;
use DB;
use Illuminate\Http\Request;

/**
 * Class OrganizationController.
 * @package App\Http\Controllers.
 */
class OrganizationController extends Controller
{

    /**
     * @var OrganizationRepository.
     */
    protected $orgRepo;

    public function __construct(OrganizationRepository $orgRepo)
    {
        $this->orgRepo = $orgRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return (new ListOrganizationViewModel($this->orgRepo, $request))->view('organization.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateOrganizationViewModel())->view('organization.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrgRequest $request)
    {
        try {

            DB::beginTransaction();

            $this->orgRepo->create($request->except('_token'));

            flash(__('Created with success'), 'success');

            DB::commit();
        } catch (\Exception $e) {

            flash(__('Error'), 'danger');

            DB::rollback();
        }

        return redirect()->route('orgs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $org)
    {
        return (new EditOrganizationViewModel($org))->view('organization.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrgRequest $request, Organization $organization)
    {
        try {

            DB::beginTransaction();

            $this->orgRepo->update($organization->id, $request->except('_token'));

            flash(__('Updated with success'), 'success');

            DB::commit();
        } catch (\Exception $e) {
            flash(__('Error'), 'danger');

            DB::rollback();
        }

        return redirect()->route('orgs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        try {

            DB::beginTransaction();

            $this->orgRepo->deleteBySlug($organization->slug);

            DB::commit();
            flash(__('Deleted with success'), 'success');

        } catch (\Exception $e) {
            flash(__('Error'), 'danger');

            DB::rollback();
        }

        return redirect()->route('orgs.index');
    }
}
