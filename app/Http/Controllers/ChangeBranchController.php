<?php

namespace App\Http\Controllers;

use App\Models\BranchDetail;
use Illuminate\Support\Facades\Cache;

/**.
 * Class ChangeBranchController.
 * @package App\Http\Controllers.
 */
class ChangeBranchController extends Controller
{


    /**
     * Change the current branch.
     * @param BranchDetail $branch.
     * @return \Illuminate\Http\JsonResponse.
     */
    public function change(BranchDetail $branch)
    {
        Cache::forget('current_branch_'.cache_key());

        Cache::rememberForever('current_branch_'.cache_key(), function () use ($branch){
            return $branch;
        });

        return response()->json(['status' => true, 'route' => route('dashboard.index')]);
    }
}
