<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Seleksi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $stp = $this->getStatusPendaftaran();
        if  ($stp == 'Aktif'){
            return view('auth.register');
        }
        return view('auth.register-closed');
    }
    
    public function getStatusPendaftaran(){
        $config = DB::table('settings')->where('config', 'status_pendaftaran')->first();
        return $config->value;
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
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|alpha_dash|max:255|unique:users',
            'nim' => 'required|integer|digits:10|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
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
            'username' => $data['username'],
            'nim' => $data['nim'],
            'password' => bcrypt($data['password']),
        ]);

        Seleksi::create([
            'id' => $user->id,
        ]);

        return $user;
    }
}
