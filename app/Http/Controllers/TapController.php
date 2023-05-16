<?php

namespace App\Http\Controllers;

use App\Http\Requests\TapRequestPost;
use App\Models\Keg;
use App\Models\Tap;
use App\Repositories\Organization\KegRepository;
use App\Repositories\Organization\TapRepository;
use App\ViewModels\CreateTapViewModel;
use App\ViewModels\EditTapViewModel;
use App\ViewModels\ListTapViewModel;
use DB;
use Illuminate\Http\Request;

class TapController extends Controller
{
    /**
     * @var TapRepository.
     */
    protected $tapRepo;

    public function __construct(TapRepository $tapRepo, KegRepository $kegRepo)
    {
        $this->tapRepo = $tapRepo;
        $this->kegRepo = $kegRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListTapViewModel($this->tapRepo))->view('taps.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateTapViewModel($this->tapRepo))->view('taps.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TapRequestPost $request)
    {
        try {
            DB::beginTransaction();

            $this->tapRepo->create($request->except('_token'));

            DB::commit();

            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {

            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('taps.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tap $tap)
    {
        return (new EditTapViewModel($tap))->view('taps.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TapRequestPost $request, Tap $tap)
    {
        try {
            DB::beginTransaction();

            $tap->update($request->except('_token'));

            DB::commit();

            flash(__('Updated with success'), 'success');

        } catch (\Exception $e) {

            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('taps.index');
    }

    /**
     * @return \Illuminate\Http\JsonResponse.
     */
    public function getActiveTaps()
    {
        $taps = $this->tapRepo->getActiveTaps();

        return response()->json(['taps' => $this->tapRepo->resolveData($taps)]);
    }

    /**
     * @param Request $request.
     * @param Tap $tap.
     * @return \Illuminate\Http\JsonResponse.
     */
    public function realeaseTap(Request $request, Tap $tap)
    {
        $tap->update([
            'keg_id' => null
        ]);

        $taps = $this->tapRepo->getActiveTaps();

        return response()->json(
            [
                'status' => true,
                'message' => __('Tap is free'),
                'taps' => $this->tapRepo->resolveData($taps),
                'route' => route('dashboard.index')
            ]
        );
    }

    /**
     * @param Tap $tap
     * @param Keg $keg
     * @return \Illuminate\Http\JsonResponse.
     */
    public function assignBarrel(Tap $tap, Keg $keg)
    {
        $tap->update([
            'keg_id' => $keg->id
        ]);

        $taps = $this->tapRepo->getActiveTaps();

        return response()->json(
            [
                'status' => true,
                'message' => __('Tap is free'),
                'taps' => $this->tapRepo->resolveData($taps),
                'route' => route('dashboard.index')
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse.
     */
    public function changeKeg(Request $request)
    {
        $keg = $this->kegRepo->getKeg($request->get('pin_keg'));

        if(!$keg) {
            return response()->json(['status' => false, 'message' => __('Keg not found')]);
        }

        if(isset($keg['taps'])) {
            return response()->json(['status' => false, 'message' => __('Keg already has a tap signed')]);
        }

        $tap = $this->tapRepo->model()->with(['keg'])->where('id', $request->get('tap_id'))->first();

        if($request->get('barrel_finished') == 1) {
            $tap->keg()->update(['status' => Keg::EMPTY]);
        } else {
            $tap->keg()->update(['status' => Keg::HALF]);
        }

        $this->kegRepo->model()->where('');

        $tap = $this->tapRepo->changeKeg($keg['keg'], $tap);
        if(!$tap instanceof Tap) {
            return response()->json(['status' => false, 'message' => __('Tap is inactive or does not exist')]);
        }




        return response()->json(
            [
                'status' => true,
                'message' => __('Changed with success'),
                'route' => route('dashboard.index')
            ]
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tap $tap)
    {
        return $tap->delete();
    }
}
