<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';



    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form(Request $request)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $request->token, 'email' => $request->email]
        );
    }

    public function doReset(Request $request)
    {
        try {
            $changed = $this->resetPasswordUser($request);

            if($changed) {
                return response()->json(
                    [
                        'status' => true,
                        'message' => __('Changed with success'),
                        'route' => route('dashboard.index')
                    ], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => __('Try again')], 400);
        }

        return response()->json(['status' => false, 'message' => __('Try again')], 400);
    }

    /**
     * @param Request $request
     */
    private function resetPasswordUser(Request $request)
    {
        $token = DB::table('password_resets')
                ->where('email', '=', $request->get('email'))
                ->where('token', '=', $request->get('token'))
                ->first();

        if(!$token) {
            return false;
        }

        $validate = $request->validate($this->rules(), $this->validationErrorMessages());
        if(!$validate)
            return false;

        $user = User::where('email', '=', $request->get('email'))->first();
        if(!$user)
            return false;

        $user->password = $request->get('password');

        DB::table('password_resets')
            ->where('email', '=', $request->get('email'))
            ->delete();

        return $user->save();
    }


    public function rules()
    {
        return [
            'password' => ['required', 'min:3']
        ];
    }
}
