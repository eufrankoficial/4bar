<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Repositories\Organization\KegRepository;

class DashboardController extends Controller
{
    /**
     * @var KegRepository.
     */
    protected $kegRepo;

    public function __construct(KegRepository $kegRepo)
    {
        $this->kegRepo = $kegRepo;
    }

    public function index()
    {
        return view('dashboard.index');
    }
}
