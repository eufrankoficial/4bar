<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     * @param $user
     */
    public function authenticated(Request $request, $user)
    {
        Cache::forget('key_'.auth()->user()->id);
        $key = Str::random();

        Cache::rememberForever('key_'.auth()->user()->id, function() use ($key) {
            return $key;
        });

        Cache::rememberForever('branchs_'.$key, function() use ($user) {
            if($user->hasRole('Admin') && $user->organization)
                return $user->organization->branchs;
            else
                return $user->branchs;
        });

        Cache::rememberForever('current_branch_'.$key, function() use ($user) {
            if($user->hasRole('Admin') && $user->organization)
                return $user->organization->branchs->first();
            else
                return $user->branchs->first();
        });

        Cache::rememberForever('menus_'.$key, function() use ($user) {
            $user = User::where('id', auth()->user()->id)->with(['group.menus'])->first();

            $menus = $user->group->map(function($group)  {
                return $group->menus->map(function($menu) {
                    return $menu;
                });
            });


            $menusids = collect([]);

            $menus->map(function($menu) use (&$menusids){
                $menu->map(function($menu) use (&$menusids) {

                    $menusids[] = $menu->id;
                });
            });

            $menusids = $menusids->toArray();

            if(count($menusids) > 0) {
                return Menu::with(['parents' => function($query) use ($menusids){
                    $query->whereIn('id', $menusids);
                }])->where('parent_id', 0)
                    ->get();
            }

            return collect([]);
        });


    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * @param Request $request.
     */
    protected function loggedOut(Request $request)
    {
        //Cache::flush();
    }
}
