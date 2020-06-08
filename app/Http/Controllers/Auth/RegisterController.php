<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Models\Meta;
use Illuminate\Http\Request;
use App\Mail\NewUserVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify-registered';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $msg = [
            'email.unique' => "Denne e-posten er allerede registrert."
        ];
        return Validator::make($data, [
//            'first_name' => ['string', 'max:255'],
//            'last_name' => ['string', 'max:255'],
//            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ],$msg);

    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


//        return view('mail.registered');


        //        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            //'username'=>$data['username'],
            'email'=>$data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->roles()->attach(5);
    
        $key = array('notification_new_ad','notification_price_changed','notification_ad_sold','notification_email','show_ratings_reviews');
        foreach($key as $k){
            Meta::updateOrCreate(['metable_id' => $user->id, 'metable_type' => 'App\User', 'key' => $k], ['value' => 1]);
        }             
//        $email = $data['email'];
//        \Mail::to($email)->send(new NewUserVerification($data, '#'));

        return $user;
    }
}
