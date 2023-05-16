<?php

namespace App\Http\View\Composers;

use App\Repositories\Organization\ColdChamberRepository;
use Illuminate\View\View;

class MeasureTemperatureViewComposer
{
    /**
     * @var ColdChamberRepository
     */
    protected $coldChamberRepo;

    /**
     * MeasureTemperatureViewComposer constructor.
     * @param ColdChamberRepository $coldChamberRepo
     */
    public function __construct(ColdChamberRepository $coldChamberRepo)
    {
        // Dependencies automatically resolved by service container...
        $this->coldChamberRepo = $coldChamberRepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $coldChambers =  $this->coldChamberRepo->coldChambersActives();
        $coldChambers = $this->coldChamberRepo->getConfigsOfColdChambers($coldChambers);

        $view->with('coldChambers', $coldChambers);
    }
}
