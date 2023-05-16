<?php

namespace App\Http\View\Composers;

use App\Repositories\Organization\ColdChamberRepository;
use App\Repositories\Organization\KegRepository;
use Illuminate\View\View;

class KegsListViewModel
{
    /**
     * @var KegRepository
     */
    protected $kegRepo;

    /**
     * KegsListViewModel constructor.
     * @param KegRepository $kegRepo
     */
    public function __construct(KegRepository $kegRepo)
    {
        $this->kegRepo = $kegRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('kegs', $this->kegRepo->kegs());
    }
}
