<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::user()){
            $date = date('d-m-Y G:i:s');
            $to_name = Auth::user()->username;
            $to_email = Auth::user()->email;
            Mail::send('mail.changed_password',compact('date'), function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Passord endret');
                $message->from('developer@digitalmx.no', 'NorgesHandel ');
            });
        }


        $this->middleware('guest');
    }
}
