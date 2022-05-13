<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;
use App\Models\Suggestion;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User;
        $user-> name=$data['name'];
        $user-> email=$data['email'];
        $user-> password=Hash::make($data['password']);
        $user-> city=$data['city'];
        $user-> address=$data['address'];
        $user-> type=$data['type'];

        if($user->type === "ES")
        {
            $user->max = 5;
        }else
        if($user->type === "ET")
        {
            $user->max = 10;
        }else
        if($user->type === "O")
        {
            $user->max = 3;
        }
        $user-> save();

        $badge = New Badge;
        $badge->email = $data['email'];
        $badge->save();

        $suggestion = New Suggestion;
        $suggestion->email = $data['email'];
        $suggestion->save();

        $subscription = New Subscription;
        $subscription->email = $data['email'];

        if($data['type'] === "ES")
        {
            $subscription->price = 2500;
        }else
        if($data['type'] === "ET")
        {
            $subscription->price = 2000;
        }else
        if($data['type'] === "O")
        {
            $subscription->price = 4000;
        }
        $subscription->save();

        return $user;
    }
}
