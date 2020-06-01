<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/';

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
        /**
         * Message for errors
         */
        $messages = 
        [
            /* Custome */
            'agree.required'    => 'Kamu harus menyetujui syarat dan ketentuan',
            'nohp.regex'        => 'Harap menggunakan nomor telefon Indonesia',
            
            /* Static */
            'required'  => ':attribute tidak boleh kosong.',
            'string'    => 'Terdapat karakter yang di larang pada :attribute.',
            'min'       => 'Jumlah karakter :attribute minimal :min.',
            'max'       => 'Jumlah karakter :attribute maksimal :max.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
        ];

        /**
         * Check the errors
         */
        return Validator::make($data, [
            'name'                      => ['required', 'string', 'min:5', 'max:255'],
            'username'                  => ['required', 'string', 'min:4', 'max:35', 'unique:users'],
            'email'                     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nohp'                      => ['required', 'string', 'max:15', 'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/', 'unique:users'],
            'password'                  => ['required', 'string', 'min:5', 'confirmed'],
            'password_confirmation'     => ['required', 'string', 'min:5'],
            'agree'                     => ['required']
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'              => $data['name'],
            'username'          => $data['username'],
            'email'             => $data['email'],
            'nohp'              => $data['nohp'],
            'password'          => Hash::make($data['password']),
        ]);
    }
}
