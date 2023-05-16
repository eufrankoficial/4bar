<?php

namespace App\Http\View\Composers;

use App\Repositories\Organization\TapRepository;
use Illuminate\View\View;

class TapFlowMeasureViewComposer
{
    /**
     * @var TapRepository
     */
    protected $tapRepo;

    public function __construct(TapRepository $tapRepo)
    {
        $this->tapRepo = $tapRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $taps = $this->tapRepo->resolveData($this->tapRepo->getActiveTaps());
        $view->with('taps', $taps);
    }
}
