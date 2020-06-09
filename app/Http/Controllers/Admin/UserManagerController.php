<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/* Admin Model */
use App\admin\UserManager;
use App\currencyIDR;

/* Datatables lib */
/* use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder; */
use App\DataTables\admin\UserManagerDataTable;



class UserManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserManagerDataTable  $dataTable)
    {

        /**
         * Build datatables
         * 
         * @return array
         */
        return $html = $dataTable->render('admin.user.home');

        /**
         * Return to admin.user.home
         */
        return view('admin.user.home');
    }

    /**
     * Display a recyle.
     *
     * @return \Illuminate\Http\Response
     */
    public function recyle()
    {
        /**
         * Return to admin.user.home
         */
        return view('admin.user.recyle');
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
        /**
         * Message when an error occurs with validation
         * 
         * @var array
         */
        $messages = 
        [
            /* Custome */
            'name.required'     => 'Nama tidak boleh kosong',
            'nohp.regex'        => 'Harap menggunakan nomor telefon Indonesia',
            'level.required'    => 'Level akun tidak boleh kosong',
            'status.required'   => 'Status akun tidak boleh kosong',
            'balance.required'  => 'Saldo tidak boleh kosong',
            'balance.integer'   => 'Saldo harus berupa angka',
            
            /* Static */
            'required'  => ':attribute tidak boleh kosong.',
            'string'    => 'Terdapat karakter yang di larang pada :attribute.',
            'min'       => 'Jumlah karakter :attribute minimal :min.',
            'max'       => 'Jumlah karakter :attribute maksimal :max.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
        ];

        /**
         * Run a validation system
         * 
         * @return array
         */
        $Validation = Validator::make($request->all(), [
            'name'                      => ['required', 'string', 'min:5', 'max:255'],
            'username'                  => ['required', 'string', 'min:4', 'max:35', 'unique:users'],
            'email'                     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nohp'                      => ['required', 'string', 'max:15', 'regex:/^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$/', 'unique:users'],
            'password'                  => ['required', 'string', 'min:5', 'confirmed'],
            'password_confirmation'     => ['required', 'string', 'min:5'],
            'level'                     => ['required', 'string'],
            'status'                    => ['required', 'string'],
            'balance'                   => ['required', 'integer'],
        ], $messages);

        /**
         * Check validation response
         * 
         * @return array
         */
        if($Validation->fails())
        {
            return response()->json(['errors' => $Validation->errors()->all()]);
        }

        /**
         * Insert to database
         * 
         * @return array
         */
        UserManager::create([
            'name'              => $request['name'],
            'username'          => $request['username'],
            'email'             => $request['email'],
            'nohp'              => $request['nohp'],
            'password'          => Hash::make($request['password']),
            'level'             => $request['level'],
            'status'            => $request['status'],
            'balance'           => $request['balance'],
        ]);

        /**
         * Return with a successful response
         * 
         * @return array
         */
        return response()->json([
            'success'   => 'Akun berhasil di tambahkan',
            'userData'  => $request['name'],
            'response'  => true
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\admin\UserManager  $userManager
     * @return \Illuminate\Http\Response
     */
    public function show(UserManager $userManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admin\UserManager  $userManager
     * @return \Illuminate\Http\Response
     */
    public function edit(UserManager $userManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admin\UserManager  $userManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserManager $userManager)
    {
        //
    }

    /**
     * Soft remove the specified resource from storage.
     *
     * @param  \App\admin\UserManager  $userManager
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
        /**
         * Get data from UserManager model
         * 
         * @return array
         */
        $user = UserManager::find($id);

        /**
         * Soft deleted
         * 
         * @return x
         */
        $user->delete();

        /**
         * Return with json
         * 
         * @return array
         */
        return response()->json([
            'success' => $user['name'] . ' dihapus sementara'
          ]);
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param  \App\admin\UserManager  $userManager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * Get data from UserManager model
         * 
         * @return array
         */
        $user = UserManager::find($id)
        ->where('id', $id)
        /**
         * Permanently deleted
         * 
         * @return x
         */
        ->forceDelete();

        /**
         * Return with json
         * 
         * @return array
         */
        return response()->json([
            'success' => $user. ' dihapus permanen'
          ]);
    }
}
