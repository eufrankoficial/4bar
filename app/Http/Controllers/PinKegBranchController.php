<?php

namespace App\Http\Controllers;

use App\Http\Requests\PinKegRequestPost;
use App\Models\Keg;
use App\Models\PinKegBranch;
use App\Repositories\Organization\KegRepository;
use App\Repositories\Organization\PinKegBranchRepository;
use App\ViewModels\CreatePinKegBranchViewModel;
use App\ViewModels\EditPinKegBranchViewModel;
use App\ViewModels\ListPinViewModel;
use DB;

class PinKegBranchController extends Controller
{
    /**
     * @var PinKegBranchRepository.
     */
    protected $kegBranchRepo;

    public function __construct(PinKegBranchRepository $pinKegBranchRepo, KegRepository $kegRepo)
    {
        $this->pinKegBranchRepo = $pinKegBranchRepo;
        $this->kegRepo = $kegRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListPinViewModel($this->pinKegBranchRepo))->view('organization.branchs.pins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreatePinKegBranchViewModel($this->pinKegBranchRepo))->view('organization.branchs.pins.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PinKegRequestPost $request)
    {
        try {
            DB::beginTransaction();

            $this->pinKegBranchRepo->create($request->except('_token'));

            DB::commit();

            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('pins.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PinKegBranch $pinKegBranch)
    {
        return (new EditPinKegBranchViewModel($pinKegBranch))->view('organization.branchs.pins.edit');
    }

    /**
     * @param PinKegBranch $pinKegBranch
     * @return \Illuminate\Http\JsonResponse.
     */
    public function getPin(PinKegBranch $pinKegBranch = null)
    {
        if(is_null($pinKegBranch)) {
            $pins = $this->kegRepo->model()->with(['beerType'])
                ->doesnthave('taps')
                ->whereNotIn('status', [Keg::COLLECTED])
                ->filter(request())->get();

            return response()->json(['status' => true, 'pins' => $pins]);
        }

        if(!$pinKegBranch) {
            return response()->json(['status' => false, 'message' => __('Keg not exists')]);
        }

        $keg = $this->kegRepo->model()->with(['taps', 'beerType'])->where('pin_keg', $pinKegBranch->pin)->filter(request())->first();

        if(!$keg) {
            return response()->json(['status' => false, 'message' => __('Keg not exists')]);
        }

        if($keg->taps) {
            return response()->json(['status' => false, 'message' => __('Keg is in another tap')]);
        }

        return response()->json(['status' => true, 'keg' => $keg]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PinKegRequestPost $request, PinKegBranch $pinKegBranch)
    {
        try {
            DB::beginTransaction();

            $this->pinKegBranchRepo->update($pinKegBranch->id, $request->except('_token'));

            DB::commit();

            flash(__('Updated with success'), 'success');

        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('pins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PinKegBranch $pinKegBranch)
    {
        return $pinKegBranch->delete();
    }
}
