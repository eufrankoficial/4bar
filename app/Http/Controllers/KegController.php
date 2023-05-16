<?php

namespace App\Http\Controllers;

use App\Http\Requests\KegRequestPost;
use App\Models\Keg;
use App\Models\PinKegBranch;
use App\Models\Tap;
use App\Repositories\Organization\KegRepository;
use App\Repositories\Organization\PinKegBranchRepository;
use App\Repositories\Organization\TapRepository;
use App\ViewModels\AttrTapToBarrelViewModel;
use App\ViewModels\CreateKegViewModel;
use App\ViewModels\EditKegViewModel;
use App\ViewModels\ListKegViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

/**
 * Class KegController.
 * @package App\Http\Controllers.
 */
class KegController extends Controller
{
    /**
     * @var KegRepository.
     */
    protected $kegRepo;

    /**
     * @var TapRepository.
     */
    protected $tapRepo;

    public function __construct(KegRepository $kegRepo, TapRepository $tapRepo, PinKegBranchRepository $pinKegRepo)
    {
        $this->kegRepo = $kegRepo;
        $this->tapRepo = $tapRepo;
        $this->pinKegRepo = $pinKegRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListKegViewModel($this->kegRepo))->view('organization.branchs.kegs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateKegViewModel($this->kegRepo))->view('organization.branchs.kegs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KegRequestPost $request)
    {
        try {

            DB::beginTransaction();

            $this->kegRepo->create($request->except('_token'));

            if($request->get('pin_keg')) {
                $this->pinKegRepo->model()->filter($request)->where('pin', $request->get('pin_keg'))->update([
                    'used' => PinKegBranch::USED
                ]);
            }

            DB::commit();

            flash(__('Created with success'), 'success');
        } catch (\Exception $e) {

            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('kegs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Keg $keg)
    {
        return (new EditKegViewModel($keg))->view('organization.branchs.kegs.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KegRequestPost $request, Keg $keg)
    {
        try {
            DB::beginTransaction();

            $keg->update($request->except('_token'));

            if($request->get('pin_keg')) {
                $this->pinKegRepo->model()->where('pin', $request->get('pin_keg'))->update([
                    'used' => PinKegBranch::USED
                ]);
            }

            DB::commit();

            flash(__('Updated with success'), 'success');

        } catch (\Exception $e) {

            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('kegs.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keg $keg)
    {
        return $keg->delete();
    }

    /**
     * @param Request $request.
     * @param Keg $keg.
     * @return bool.
     */
    public function outKeg(Request $request, Keg $keg)
    {
        $keg->taps()->update([
            'keg_id' => null
        ]);

        $keg->update([
            'outbound_datetime' =>  now()->format('d/m/Y'),
            'outbound_name' => $request->get('outbound_name'),
            'status' => $request->get('status')
        ]);

        return response()->json(
            [
                'status' => true,
                'message' => __('Successfully collected')
            ]
        );
    }

    /**
     * @param Tap $tap.
     * @param Keg $keg.
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function deleteTap(Tap $tap, Keg $keg)
    {
        DB::beginTransaction();
        $tap->update(['keg_id' => null]);

        DB::commit();

        return redirect()->back();
    }

    /**
     * @param Keg $keg.
     * @return \Spatie\ViewModels\ViewModel.
     */
    public function attrTapToBarrel(Keg $keg)
    {
        return (new AttrTapToBarrelViewModel($keg))->view('taps.tap_keg_add');
    }

    /**
     * @param Request $request
     * @param Keg $keg
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function saveTap(Request $request, Keg $keg)
    {
        try {

            DB::beginTransaction();

            $tap = $this->tapRepo->findById($request->get('tap_id'));

            $this->tapRepo->update($tap->id, [
                'keg_id' => $keg->id
            ]);

            DB::commit();

            flash(__('Successfully assigned'), 'success');


        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->back();
    }
}
