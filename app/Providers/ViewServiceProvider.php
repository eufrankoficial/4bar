<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            ['partials.right_bar', 'partials.nav_top', 'partials.menu'], 'App\Http\View\Composers\MeasureTemperatureViewComposer'
        );

        View::composer(
            ['elements.taps.list'], 'App\Http\View\Composers\TapFlowMeasureViewComposer'
        );

        View::composer(
            ['dashboard.index'], 'App\Http\View\Composers\KegsListViewModel'
        );
    }
}
