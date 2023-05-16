<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorTypeRequestPost;
use App\Models\SensorType;
use App\Repositories\Organization\SensorTypeRepository;
use App\ViewModels\CreateSensorTypeViewModel;
use App\ViewModels\EditSensorTypeViewModel;
use App\ViewModels\ListSensorTypeViewModel;
use Illuminate\Http\Request;
use DB;

class SensorTypeController extends Controller
{
    /**
     * @var SensorTypeRepository.
     */
    protected $sensorTypeRepo;

    public function __construct(SensorTypeRepository $sensorTypeRepo)
    {
        $this->sensorTypeRepo = $sensorTypeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListSensorTypeViewModel($this->sensorTypeRepo))->view('sensor_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateSensorTypeViewModel($this->sensorTypeRepo))->view('sensor_type.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SensorTypeRequestPost $request)
    {
        try {
            DB::beginTransaction();

            $this->sensorTypeRepo->create($request->except('_token'));

            DB::commit();

            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {
            DB::rollback();

            dd($e);

            flash(__('Error'), 'danger');
        }

        return redirect()->route('sensor_type.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SensorType $sensorType)
    {
        return (new EditSensorTypeViewModel($this->sensorTypeRepo, $sensorType))->view('sensor_type.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SensorTypeRequestPost $request, SensorType $sensorType)
    {
        try {

            DB::beginTransaction();

            $this->sensorTypeRepo->update($sensorType->id, $request->except('_token'));

            flash(__('Updated with success'), 'success');

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'),'danger');
        }

        return redirect()->route('sensor_type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SensorType $sensorType)
    {
        flash(__('Deleted with success'), 'success');
        return $sensorType->delete();
    }
}
