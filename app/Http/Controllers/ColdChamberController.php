<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColdChamberRequestPost;
use App\Models\ColdChamber;
use App\Repositories\Organization\ColdChamberRepository;
use App\ViewModels\AddColdChamberViewModel;
use App\ViewModels\EditColdChamberViewModel;
use App\ViewModels\ListColdChamberViewModel;
use DB;
use Illuminate\Http\Request;

class ColdChamberController extends Controller
{
    /**
     * @var ColdChamberRepository.
     */
    protected $coldChamberRepo;

    public function __construct(ColdChamberRepository $coldChamberRepo)
    {
        $this->coldChamberRepo = $coldChamberRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListColdChamberViewModel($this->coldChamberRepo))->view('cold_chamber.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new AddColdChamberViewModel($this->coldChamberRepo))->view('cold_chamber.add')->toResponse(request());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColdChamberRequestPost $request)
    {
        try {

            DB::beginTransaction();

            $this->coldChamberRepo->create($request->except('_token'));

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['status' => false, 'message' => __('Something Wrong')]);
        }

        return response()->json(['status' => true, 'message' => __('Created with success'), 'route' => route('cold_chamber.index')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ColdChamber $coldChamber)
    {
        return (new EditColdChamberViewModel($coldChamber))->view('cold_chamber.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColdChamberRequestPost $request, ColdChamber $coldChamber)
    {
        try {

            DB::beginTransaction();

            $coldChamber->update($request->except('_token'));

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => false, 'message' => __('Something Wrong')]);
        }

        return response()->json(['status' => true, 'message' => __('Updated with success'), 'route' => route('cold_chamber.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColdChamber $coldChamber)
    {
        return $coldChamber->delete();
    }

    /**
     * Returns tempereture from coldchamber.
     * @return \Illuminate\Http\JsonResponse.
     */
    public function temperature()
    {
        $coldChambers = $this->coldChamberRepo->coldChambersActives();
        $coldChambers = $this->coldChamberRepo->getConfigsOfColdChambers($coldChambers);

        return response()->json([
            'current' => $coldChambers->first(),
            'list' => $coldChambers,
        ], 200);
    }
}
