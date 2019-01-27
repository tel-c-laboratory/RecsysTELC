<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if(Auth::guest()){
            $stp = $this->getStatusPendaftaran();
            return view('auth.login', compact('stp'));
        } else {
            return redirect()->route('home');
        }
    }

    public function getStatusPendaftaran(){
        $config = DB::table('settings')->where('config', 'status_pendaftaran')->first();
        return $config->value;
    }

    public function username()
    {
      return 'username';
    }
}
