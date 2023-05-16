<?php

namespace App\ViewModels;

use App\Models\Calendar;
use Spatie\ViewModels\ViewModel;

/**
 * Class EditCalendarViewModel
 * @package App\ViewModels.
 */
class EditCalendarViewModel extends ViewModel
{
    /**
     * @var Calendar.
     */
    protected $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
        $this->calendar->load('branch.org');
    }

    /**
     * @return Calendar.
     */
    public function calendar(): Calendar
    {
        return $this->calendar;
    }

    /**
     * @return array.
     */
    public function days(): array
    {
        return Calendar::WEEk_DAY;
    }
}
