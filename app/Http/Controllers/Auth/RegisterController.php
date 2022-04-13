<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserWelcomeEmail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {

            return Validator::make($data, [
                //'name' => ['required', 'string', 'max:12','regex:/^[A-Za-z]+$/'],
                'username' => ['required', 'string', 'max:12','regex:/^[A-Za-z]+$/', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'password' => ['required', 'string', 'min:8', 'confirmed'],
                //'phone' => ['nullable','regex:/^[0-9]{10,15}+$/'],
            ],

                [
                    'username.required' =>'Required',
                    'username.regex' =>'Only Characters allowed',
                    'email.required' =>'Required',
                    'email.email' =>'Not Valid',
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        $pass = Str::random(4).rand(1000000, 9999);

        $user =  User::create([
             'name' => Str::ucfirst($data['username']),
             'username' => Str::lower($data['username']),
             'email' => $data['email'],
             'pass' => $pass,
             'password' => Hash::make($pass),
             'role'=>'U',
             'active'=>'Y',
        ]);

        $data =  [
            'name' => Str::ucfirst($data['username']),
            'email' => $data['email'],
            'pass' => $pass,
        ];


        Mail::to($data['email'])->Send(new UserWelcomeEmail($data));
        return $user;

    }
}
