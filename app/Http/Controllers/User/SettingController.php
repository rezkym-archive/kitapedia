<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/* Include model */
use App\User;
use App\crudSecurity;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.home');
    }

    /**
     * Display a listing of the general.
     *
     * @return \Illuminate\Http\Response
     */
    public function general(Request $request, User $user)
    {
        /**
         * User data from session
         */
        $userData = auth()->user();

        return view('settings.general', compact('userData'));
    }

    /**
     * Display a listing of the api.
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        return view('settings.api');
    }

    /**
     * Display a listing of the api.
     *
     * @return \Illuminate\Http\Response
     */
    public function security()
    {
        /**
         * User data from session
         */
        $userData = auth()->user();

        return view('settings.security', compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * Retrieve the specified resource from the database
         * 
         * @param int $id
         * @return \App\admin
         */
        $userAccount = User::find($id);

    }

    /**
     * Update general resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generalUpdate(Request $request, $id)
    {
        /**
         * Check security
         */
        $messageSecurity = 'Terdeteksi mengubah _user pada element formulir perbarui informasi akun <general></general>';
        crudSecurity::isSecure($request->_user, $messageSecurity);
        
        /**
         * Displays requested user data
         */
        $userAccount = User::findOrFail($id);

        /**
         * Split first and last name, request and original
         */

        /* Merge name */
        $requestName = $request->first_name;
        $requestName .= ' '.$request->last_name;
        
        /* Split Original */
        $splitOriginal  = explode(' ', $userAccount->name, 2);

        /* Split request */
        $splitRequest   = explode(' ', $requestName, 2);

        /**
         * Set the part you want to change
         */
        $checkFirstName = (empty($request->first_name) ? $splitOriginal[0]  : $splitRequest[0]);
        $checkLastName  = (empty($request->last_name) ? $splitOriginal[1]  : $splitRequest[1]);
        $checkEmail     = (empty($request->email) ? $userAccount->email : $request->email);
        $checkNoHp      = (empty($request->nohp) ? $userAccount->nohp : $request->nohp);

        /**
         * Validation Rule
         * 
         * @return array
         */
        $ValidationRule = 
        [
            'first_name'    => ['required', "regex:/^[a-z ,.'-]+$/i", 'min:5', 'max:50'],
            'last_name'     => ["regex:/^[a-z ,.'-]+$/i", 'max:50'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$userAccount->id],
            'nohp'          => ['required', 'string', 'min:8', 'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/', 'unique:users,nohp,'.$userAccount->id]
        ];

        /**
         * Validation Message
         * 
         * @return array
         */
        $ValidationMessage = 
        [
            'required'  => ':attribute tidak boleh kosong.',
            'string'    => 'Terdapat karakter yang di larang',
            'min'       => 'Jumlah karakter :attribute minimal :min',
            'max'       => 'Jumlah karakter :attribute maksimal :max',

            'first_name.required'   => 'Nama depan tidak boleh kosong',
            'first_name.regex'      => 'Terdapat karakter terlarang pada nama depan',
            'first_name.min'        => 'Nama depan minimal :min karakter',
            'first_name.max'        => 'Nama depan maksimal :max karakter',

            'last_name.regex'       => 'Terdapat karakter terlarang pada nama belakang',

            'email.email'   => 'Format email salah',
            'email.unique'  => 'Email telah digunakan',

            'nohp.regex'        => 'Nomor telefon tidak diketahui',
            'nohp.unique'       => 'Nomor telefon telah digunakan',

        ];

        /**
         * Run a validation system
         * 
         * @return array
         */
        $Validation = Validator::make([
            'first_name'    => $checkFirstName,
            'last_name'     => $checkLastName,
            'email'         => $checkEmail,
            'nohp'          => $checkNoHp, 

        ], $ValidationRule, $ValidationMessage);

        /**
         * Check validation response
         * 
         * @return array
         */
        if($Validation->fails())
        {
            /**
             * Result failed
             */
            return response()->json([
                'status'    => false,
                'message'   => 'Gagal mengubah',
                'result'    => $Validation->errors()->all()
            ]);

        }

        /**
         * Merge first and last name
         */
        $name = $checkFirstName;
        $name .= ' '.$checkLastName;

        /**
         * Update information
         */
        $userAccount->name = $name;
        $userAccount->email = $checkEmail;
        $userAccount->nohp  = $checkNoHp;

        /**
         * Save change
         */
        $userAccount->save();
        
        if($request->ajax()) {

            /**
             * Result success
             */
            return response()->json([
                'status'   => true,
                'message'   => 'Berhasil memperbarui',
                'result'    => [
                    'name'      => $name,
                    'email'     => $checkEmail,
                    'nohp'      => $checkNoHp
                ]
            ]);

        }
        

    }

    /**
     * Update Security & Info resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function securityUpdate(Request $request, $id)
    {
        /**
         * Check security
         */
        $messageSecurity = 'Terdeteksi mengubah _user pada element formulir perbarui informasi akun <security&info>';
        crudSecurity::isSecure($request->_user, $messageSecurity);

        /**
         * Displays requested user data
         */
        $userAccount = User::findOrFail($id);

        /**
         * Validation Rules
         */
        $ValidationRule = 
        [
            'new_password'              => ['required', 'min:5', 'confirmed'],
            'new_password_confirmation' => ['required', 'min:5'],
            'old_password'              => ['required', 'min:5'],
        ];

        /**
         * Validation Message
         * 
         * @return array
         */
        $ValidationMessage = 
        [
            'new_password.required' => 'Kata sandi baru tidak boleh kosong',
            'new_password.min'      => 'Karakter kata sandi baru minimal :min karakter',
            'new_password.confirmed'    => 'Konfirmasi kata sandi baru tidak cocok',
            
            'new_password_confirmation.required' => 'Konfirmasi kata sandi baru tidak boleh kosong',
            'new_password_confirmation.min'      => 'Konfirmasi kata sandi baru minimal :min karakter',

            'old_password.required' => 'Kata sandi lama tidak boleh kosong',
            'old_password.min'      => 'Kata sandi lama minimal :min karakter',
        ];

        /**
         * Run a validation system
         * 
         * @return array
         */
        $Validation = Validator::make([
            'new_password'                  => $request->new_password,
            'new_password_confirmation'     => $request->new_password_confirmation,
            'old_password'                  => $request->old_password,

        ], $ValidationRule, $ValidationMessage);

        /**
         * Check validation response
         * 
         * @return array
         */
        if($Validation->fails())
        {
            /**
             * Result failed
             */
            return response()->json([
                'status'    => false,
                'message'   => 'Gagal mengubah',
                'result'    => $Validation->errors()->all()
            ]);

        }

        /**
         * Old password checking
         */
        if(!Hash::check($request->old_password, $userAccount->password))
        {
            /**
             * Result failed
             */
            return response()->json([
                'status'    => false,
                'message'   => 'Gagal',
                'result'    => 'Kata sandi lama tidak cocok'
            ]);

        }

        /**
         * Encrypt new password
         * 
         * @return string
         */
        $EncryptPassword = Hash::make($request->new_password);

        /**
         * Update data
         */
        $userAccount->password = $EncryptPassword;

        /**
         * Save Update
         */
        $userAccount->save();

        /**
         * Logout
         */
        auth()->logout();

        /**
         * Result success
         */
        return response()->json([
            'status'    => true,
            'isLogout'  => true,
            'message'   => 'Berhasil memperbarui',
            'result'    => 'Kamu akan otomatis di arahkan keluar yaa setelah inii..',
        ]);
        
        


        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
