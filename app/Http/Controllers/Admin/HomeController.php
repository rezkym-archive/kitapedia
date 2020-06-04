<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/* Use Admin Model */
use App\User;
use App\currencyIDR;
use App\transaction;
use App\admin\trx\transactionPPOB;
use App\admin\trx\transactionSosmed;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void{{  }}
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /**
         * Static Data
         */
        $username = auth()->user()->username;

        /**
         * User Data
         */
        $dataUser = User::where('username', $username)->first();

        /**
         * Count all Sales
         */
        $totalSales = $this->sales();

        /**
         * Status Transaction
         */
        $transactionStatus = self::orderStatus();

        /**
         * Transaction
         * 
         * use transactionPPOB as a parent to transactionSosmed
         * the relationship is belongsTo
         */
        #$transactionPPOB    = transactionPPOB::all();
        #$transactionSosmed  = transactionSosmed::all();
        $transaction        = transaction::all();
        //dd($transaction[3]->transactionSosmed);

        #$date = date("Y-m-d H");

        /* $transactionAll = DB::table(DB::raw('transaction_ppob as ppob, transaction_sosmed as sosmed'))
        ->select(DB::raw('ppob.username as p_username, ppob.service as p_service, sosmed.username as s_username, sosmed.type as s_type'))
        ->whereDate('ppob.created_at', Carbon::today())
        ->whereDate('sosmed.created_at', Carbon::today())
        ->get(); */
        

        /**
         * Return to admin home
         */
        return view('admin.home', [

            'user'              => $dataUser,
            'transactionUser'   => $transaction,
            'totalSales'        => $totalSales,
            'trxStatus'         => $transactionStatus,

            ]);
    }

    /**
     * Count the sales product
     * 
     * PPOB
     * Sosmed
     */
    private function sales()
    {
        /**
         * Transaction PPOB
         */
        $countPPOB      = transactionPPOB::select('price')->sum('price');
        $countSosmed    = transactionSosmed::select('price')->sum('price');
        
        /**
         * Addition of both
         */
        $countOfBoth = $countPPOB + $countSosmed;

        /**
         * IDR Currency
         */
        $toIDR  = currencyIDR::beCalculated($countOfBoth);

        return $toIDR;
    }

    private static function orderStatus()
    {
            /**
             * Count Status PPOB
             * 
             * Success, pending, error
             */
            $transaction = DB::select(DB::raw(

                "SELECT 
                (SELECT COUNT(*) FROM transaction_ppob WHERE status='success') +
                (SELECT COUNT(*) FROM transaction_sosmed WHERE status='success') as sukses,
                
                
                (SELECT COUNT(*) FROM transaction_ppob WHERE status='pending') +
                (SELECT COUNT(*) FROM transaction_sosmed WHERE status='pending') as pending,
                
                
                (SELECT COUNT(*) FROM transaction_ppob WHERE status='error') +
                (SELECT COUNT(*) FROM transaction_sosmed WHERE status='error') as error "
                
            ));

            /**
             * Return back status
             */
            return $transaction;

    }
}
