<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarRequestPost;
use App\Models\BranchDetail;
use App\Models\Calendar;
use App\Models\Organization;
use App\Repositories\Organization\CalendarRepository;
use App\ViewModels\CreateCalendarViewModel;
use App\ViewModels\EditCalendarViewModel;
use App\ViewModels\ListCalendarViewModel;
use DB;

/**
 * Class CalendarController
 * @package App\Http\Controllers.
 */
class CalendarController extends Controller
{

    /**
     * @var CalendarRepository.
     */
    protected $calendarRepo;

    public function __construct(CalendarRepository $calendarRepo)
    {
        $this->calendarRepo = $calendarRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Organization $org, BranchDetail $branch)
    {
        return (new ListCalendarViewModel($branch))->view('organization.branchs.calendar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Organization $org, BranchDetail $branch)
    {
        return (new CreateCalendarViewModel($branch))->view('organization.branchs.calendar.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarRequestPost $request, Organization $org, BranchDetail $branch)
    {
        try {

            DB::beginTransaction();

            $merge = [
                'organization_id' => $org->id,
                'branch_id' => $branch->id
            ];

            $request->merge($merge);

            $this->calendarRepo->create($request->except('_token'));

            DB::commit();

            flash(__('Created with success'), 'success');


        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('orgs.branchs.calendar.index', [$org, $branch]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $org, BranchDetail $branch, Calendar $calendar)
    {
        return (new EditCalendarViewModel($calendar))->view('organization.branchs.calendar.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalendarRequestPost $request, Organization $org, BranchDetail $branch, Calendar $calendar)
    {
        try {

            DB::beginTransaction();

            $this->calendarRepo->update($calendar->id, $request->except('_token'));

            DB::commit();

            flash(__('Updated with success'), 'success');


        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('orgs.branchs.calendar.index', [$org, $branch]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $org, BranchDetail $branch, Calendar $calendar)
    {
        flash(__('Deleted with success'), 'success');
        return $calendar->delete();
    }
}
