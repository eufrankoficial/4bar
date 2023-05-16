<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarningColdChamberPost;
use App\Http\Requests\WarningKegPost;
use App\Models\ColdChamber;
use App\Models\Keg;
use App\Models\Warning;
use App\Repositories\Organization\KegRepository;
use App\Repositories\Organization\WarningRepository;
use App\ViewModels\CreateColdChamberAlertViewModel;
use App\ViewModels\CreateKegAlertViewModel;
use DB;

/**
 * Class AlertController.
 * @package App\Http\Controllers.
 */
class AlertController extends Controller
{
    /**
     * @var KegRepository.
     */
    protected $kegRepo;

    /**
     * @var WarningRepository.
     */
    protected $warningRepo;

    public function __construct(KegRepository $kegRepo, WarningRepository $warningRepo)
    {
        $this->kegRepo = $kegRepo;
        $this->warningRepo = $warningRepo;
    }


    /**
     * View alert to kegs
     * @param Keg $keg
     * @return \Symfony\Component\HttpFoundation\Response.
     */
    public function kegAlertAdd(Keg $keg)
    {
        return (new CreateKegAlertViewModel($keg))->view('organization.branchs.alerts.modal.create')->toResponse(request());
    }

    /**
     * @param WarningKegPost $request
     * @param Keg $keg
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAlertKeg(WarningKegPost $request, Keg $keg)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token');
            $data['keg_id'] = $keg->id;

            $this->warningRepo->create($data);

            DB::commit();

            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('kegs.index');
    }

    /**
     * @param ColdChamber $coldChamber
     * @return \Spatie\ViewModels\ViewModel
     */
    public function coldChamberAdd(ColdChamber $coldChamber)
    {
        return (new CreateColdChamberAlertViewModel($coldChamber))->view('cold_chamber.modal.add');
    }

    /**
     * @param WarningColdChamberPost $request
     * @param ColdChamber $coldChamber
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function storeAlertColdChamber(WarningColdChamberPost $request, ColdChamber $coldChamber)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token');
            $data['cold_chamber_id'] = $coldChamber->id;

            $this->warningRepo->create($data);

            DB::commit();

            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('cold_chamber.index');
    }

    /**
     * @param Warning $warning
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception.
     */
    public function destroy(Warning $warning)
    {
        $warning->delete();

        flash(__('Deleted with success'), 'success');

        return redirect()->back();
    }
}
