<?php

namespace App\Http\Controllers;

use App\Http\Requests\DevicePostRequest;
use App\Models\Device;
use App\Repositories\Config\DeviceRepository;
use App\ViewModels\CreateDeviceViewModel;
use App\ViewModels\EditDeviceViewModel;
use App\ViewModels\ListDeviceViewModel;
use DB;

class DeviceController extends Controller
{
    /**
     * @var DeviceRepository.
     */
    protected $deviceRepo;

    public function __construct(DeviceRepository $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListDeviceViewModel($this->deviceRepo))->view('devices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateDeviceViewModel($this->deviceRepo))->view('devices.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DevicePostRequest $request)
    {
        try {

            DB::beginTransaction();

            $this->deviceRepo->create($request->except('_token'));

            DB::commit();

            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {

            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('devices.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return (new EditDeviceViewModel($device))->view('devices.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DevicePostRequest $request, Device $device)
    {
        try {

            DB::beginTransaction();

            $this->deviceRepo->update($device->id, $request->except('_token'));

            DB::commit();

            flash(__('Updated with success'), 'success');

        } catch (\Exception $e) {

            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        return $device->delete();
    }
}
