<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeerTypeRequestPost;
use App\Models\BeerType;
use App\Repositories\Organization\BeerTypeRepository;
use App\ViewModels\CreateBeerTypeViewModel;
use App\ViewModels\EditBeerTypeViewModel;
use App\ViewModels\ListBeerTypeViewModel;
use DB;

/**
 * Class BeerTypeController.
 * @package App\Http\Controllers.
 */
class BeerTypeController extends Controller
{

    public function __construct(BeerTypeRepository $beerTypeRepo)
    {
        $this->beerTypeRepo = $beerTypeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListBeerTypeViewModel($this->beerTypeRepo))->view('beer_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateBeerTypeViewModel($this->beerTypeRepo))->view('beer_type.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeerTypeRequestPost $request)
    {
        try {

            DB::beginTransaction();

            $this->beerTypeRepo->add($request);

            DB::commit();

            flash(__('Created with succes'), 'success');

        } catch (\Exception $e) {
dd($e);
            DB::rollback();
            flash(__('Error'), 'danger');
        }

        return redirect()->route('beer_type.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BeerType $beerType)
    {
        return (new EditBeerTypeViewModel($beerType))->view('beer_type.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeerTypeRequestPost $request, BeerType $beerType)
    {
        try {

            DB::beginTransaction();

            $this->beerTypeRepo->update($beerType->id, $request->except('_token', 'branch_id'));

            DB::commit();

            flash(__('Updated with succes'), 'success');

        } catch (\Exception $e) {

            DB::rollback();
            flash(__('Error'), 'danger');
        }

        return redirect()->route('beer_type.index');
    }


    public function importNatives()
    {
        try {
            DB::beginTransaction();

            $this->beerTypeRepo->import();

            DB::commit();

            flash(__('Imported with success'), 'success');

        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('beer_type.index');
    }

    /**
     * @param BeerType $beerType.
     * @return bool.
     */
    public function approve(BeerType $beerType)
    {
        return $beerType->update([
            'status' => BeerType::STATUS_APPROVED
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BeerType $beerType)
    {
        flash(__('Deleted with success'), 'success');

        if(current_user()->hasRole('SuperAdmin')) {
            return $beerType->delete();
        }

        return $this->beerTypeRepo->remove($beerType);
    }
}
