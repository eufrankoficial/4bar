<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.passwords.index');
    }

    public function sendEmail(Request $request)
    {
        try {

            $user = User::where('email', $request->get('email'))->first();

            if($user && $this->sendResetLinkEmail($request)) {
                return response()->json(['status' => true, 'message' => __('Email sended with success')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => __('User not found')], 400);
        }

        return response()->json(['status' => false, 'message' => __('Something is not okay')], 200);
    }


    private function sendResetLinkEmail(Request $request)
    {
        $user = User::where('email', '=', $request->get('email'))
            ->first();

        if (!$user) {
            return abort(404);
        }

        \DB::table('password_resets')->insert([
            'email' => $request->get('email'),
            'token' => bcrypt($request->get('email')),
            'created_at' => now()
        ]);

        $token = \DB::table('password_resets')
            ->where('email', '=', $request->get('email'))->first();

        $sendEmail = $this->sendEmailToUser($user, $token->token, $request->get('email'));

        if ($sendEmail)
            return true;

        return false;
    }


    private function sendEmailToUser(User $user, $token, $email)
    {
        return $user->notify(new ResetPasswordNotification($token, $email));
    }

}
