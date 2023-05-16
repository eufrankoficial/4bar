<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Repositories\Config\SensorRepository;
use App\ViewModels\AddSensorViewModel;
use App\ViewModels\EditSensorViewModel;
use App\ViewModels\ListSensorViewModel;
use Illuminate\Http\Request;
use DB;

class SensorController extends Controller
{
    /**
     * @var SensorRepository.
     */
    protected $sensorRepo;

    public function __construct(SensorRepository $sensorRepo)
    {
        $this->sensorRepo = $sensorRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListSensorViewModel($this->sensorRepo))->view('sensors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!request()->ajax())
            abort(404);

        return (new AddSensorViewModel($this->sensorRepo))->view('sensors.add')->toResponse(request());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->sensorRepo->create($request->except('_token'));

            DB::commit();

            flash(__('Added with success'), 'success');

        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('sensors.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sensor $sensor)
    {
        if(!request()->ajax())
            abort(404);

        return (new EditSensorViewModel($this->sensorRepo, $sensor))->view('sensors.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sensor $sensor)
    {
        try {

            DB::beginTransaction();

            $sensor->update($request->except('_token'));

            DB::commit();

            flash(__('Updated with success'), 'success');

        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('sensors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sensor $sensor)
    {
        return $sensor->delete();
    }
}
