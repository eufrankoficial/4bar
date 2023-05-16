<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequestPost;
use App\Models\Menu;
use App\Repositories\Config\MenuRepository;
use App\ViewModels\CreateMenuViewModel;
use App\ViewModels\EditMenuViewModel;
use App\ViewModels\ListMenuViewModel;
use Illuminate\Http\Request;
use DB;

class MenuController extends Controller
{
    /**
     * @var MenuRepository.
     */
    protected $menuRepo;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListMenuViewModel($this->menuRepo))->view('menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateMenuViewModel($this->menuRepo))->view('menus.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequestPost $request)
    {
        try {
            DB::beginTransaction();

            $menu = $this->menuRepo->create($request->except('_token', 'parents'));

            if($request->get('parents'))
                $this->menuRepo->saveParents($menu, $request->get('parents'));

            DB::commit();

            flash(__('Created with success'), 'success');

        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('menu.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return (new EditMenuViewModel($menu))->view('menus.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequestPost $request, Menu $menu)
    {
        try {

            DB::beginTransaction();

            $menu = $this->menuRepo->update($menu->id, $request->except('_token', 'parents'));

            if($request->get('parents')) {
                $this->menuRepo->saveParents($menu, $request->get('parents'));
            } else {
                $menu->parents()->delete();
                $menu->parent_id = 0;
                $menu->save();
            }



            DB::commit();

            flash(__('Updated with success'), 'success');

        } catch (\Exception $e) {
            DB::rollback();

            flash(__('Error'), 'danger');
        }

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        return $menu->delete();
    }
}
