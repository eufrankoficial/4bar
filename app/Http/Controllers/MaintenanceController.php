<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceRequestPost;
use App\Models\Maintenance;
use App\Repositories\Organization\MaintenanceRepository;
use App\ViewModels\AddMaintenanceViewModel;
use App\ViewModels\ListMaintenanceViewModel;
use App\ViewModels\ViewMaintenanceViewModel;
use DemeterChain\Main;
use Illuminate\Http\Request;
use DB;

class MaintenanceController extends Controller
{

    /**
     * @var MaintenanceRepository.
     */
    protected $maintenanceRepo;

    public function __construct(MaintenanceRepository $maintenanceRepo)
    {
        $this->maintenanceRepo = $maintenanceRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListMaintenanceViewModel($this->maintenanceRepo))->view('maintenance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new AddMaintenanceViewModel($this->maintenanceRepo))->view('maintenance.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaintenanceRequestPost $request)
    {
        try {

            DB::beginTransaction();

            $maintenance = $this->maintenanceRepo->create($request->except('_token'));

            DB::commit();

            return response()->json(['status' => true, 'maintenance' => $maintenance, 'route' => route('maintenance.index')], 200);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json(['status' => false], 400);
        }
    }

    /**
     * @param Maintenance $maintenance
     * @return \Symfony\Component\HttpFoundation\Response.
     */
    public function show(Maintenance $maintenance)
    {
        return (new ViewMaintenanceViewModel($maintenance))->view('maintenance.view')->toResponse(request());
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return response()->json(['status' => true]);
    }
}
