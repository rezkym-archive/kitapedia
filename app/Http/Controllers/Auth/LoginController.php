<?php

namespace App\Http\Controllers\Auth;

/* Use Illuminate */
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;

/* Use Auth */
use Auth;

/* Use User Model */
use App\User;
use App\user\CheckStatus;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Login function
     *
     * @return void
     */
    public function login(Request $request)
    {
        /** 
         * Request Credentials
         */
        $username   = $request->username;
        $email      = $request->username;
        $password   = $request->password;
        $isEmail    = filter_var($email, FILTER_VALIDATE_EMAIL);

        /**
         * Get Account From Database
         */
        $getByEmail     = User::whereEmail($email)->first();
        $getByUsername  = User::whereUsername($username)->first();

        /**
         * Get Account Status
         */
        $userStatus = $this->checkStatusAccount($username);

        /**
         * Filter Credentials
         * 
         * withError
         * this function is use key name="username" in login.blade.php
         */
        if($getByEmail == false AND $isEmail == true)
        {
            /**
             * If Email not found
             */
            return redirect()->back()->withErrors(['username' => 'Email tidak di temukan'])->withInput();
            
        } else if($getByUsername == false AND $isEmail == false)
        {
            /**
             * If Username notfound
             */
            return redirect()->back()->withErrors(['username' => 'Username tidak di temukan'])->withInput();

        } else if($userStatus['status'] != true)
        {
            /**
             * If status account is not actived
             */
            return redirect()->back()->withErrors(['error' => $userStatus['msg']])->withInput();

        } else 
        {
            $loginUsing = ($getByEmail) ? $email : $username;
            $loginKey   = ($getByEmail) ? 'email' : 'username';
        }

        /**
         * Login Process
         */
        if (Auth::attempt([$loginKey => $loginUsing, 'password' => $password])) 
        {
            
            /**
             * If Login successfuly, redirect to dashboard
             */
            $user = auth()->user();
            $home = route($user->role . '.home');
            return redirect()->intended($home);
        }

        /**
         * If failed to login turn back to login form
         * and give error password
         */
        return redirect()->back()->withInput($request->only('username'))->withErrors(
        [
            'password' => 'Kata sandi salah',
        ]);

        /**
         * If login is successfuly then redirect to home
         */
        //return redirect()->route('home');

    }

    /**
     * Check Account Status Function
     *
     * @return void
     */
    private function checkStatusAccount($username)
    {
        /**
         * Get user account information
         */
        $getAccount = User::where('username', $username)
        ->orWhere('email', $username)
        ->first();

        /**
         * Check if user avaible
         */
        if(!empty($getAccount))
        {
            $userStatus = $getAccount->status;

        } else 
        {
            $userStatus = 'notfound';
        }

        /**
         * Filter status
         */
        switch ($userStatus) {
            case 'nonactive':
                return [
                    'status'    => false,
                    'msg'       => 'Mohon maaf akun kamu belum aktif, hubungi layanan bantuan'
                ];
                break;

            case 'suspended':
                return [
                    'status'    => false,
                    'msg'       => 'Mohon maaf akun kamu di tangguhkan, hubungi layanan bantuan'
                ];
                break;

            case 'deleted':
                return [
                    'status'    => false,
                    'msg'       => 'Mohon maaf akun kamu sudah terhapus, hubungi layanan bantuan'
                ];
                break;

            case 'notfound':
                return [
                    'status'    => false,
                    'msg'       => 'Akun tersebut belum terdaftar'
                ];
                break;
            
            default:
            return [
                'status'    => true,
                'msg'       => 'ACCOUNT_STATUS_CONFIRMED'
            ];
                break;
        }
    }
}
