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
use App\Charts\transactionChart;


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
         * Count all Sales \ function sales()
         * 
         * @return array
         */
        $totalSales = $this->sales();

        /**
         * Status Transaction
         */
        $transactionStatus = self::orderStatus();
        
        /**
         * Chart transaction
         */
        $transactionChart = self::transactionChart();


        /**
         * Transaction
         * 
         * use transactionPPOB as a parent to transactionSosmed
         * the relationship is belongsTo
         */
        $transaction        = transaction::limit(4)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        $transactionPPOB    = transactionPPOB::all();
        $transactionSosmed  = transactionSosmed::all();
        #dd($transaction[3]->transactionSosmed);
        

        /**
         * Return to admin home
         */
        return view('admin.home', 
        [

            'user'              => $dataUser,
            'transactionUser'   => $transaction,
            'totalSales'        => $totalSales,
            'trxStatus'         => $transactionStatus,
            'transactionChart'  => $transactionChart,

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
         * Array Sales
         * 
         * All Sales
         * PPOB Sales
         * Sosmed Sales
         */
        $sales = 
        [
            'allSales'      => currencyIDR::beCalculated($countOfBoth),
            'ppobSales'     => currencyIDR::beCalculated($countPPOB),
            'sosmedSales'   => currencyIDR::beCalculated($countSosmed),
        ];

        return $sales;
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

    private static function transactionChart()
    {
        $chartSosmed = collect([]); // Could also be an array
        $chartPPOB = collect([]); // Could also be an array
        $format = collect([]); // Could also be an array

        for ($days_backwards = 7; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $chartSosmed->push(transaction::whereDate('created_at', Carbon::tomorrow()
                                                    ->subDays($days_backwards)
                                                )
                                                ->where('type', 'sosmed')
                                    ->count());
            $chartPPOB->push(transaction::whereDate('created_at', Carbon::tomorrow()
                                                    ->subDays($days_backwards)
                                                )
                                                ->where('type', 'ppob')
                                    ->count());
            $format->push(Carbon::tomorrow()->subDays($days_backwards)->format('d-m'));
        }
    

        $chart = new transactionChart;
        $chart->labels($format);
        $chart->dataset('Sosmed', 'line', $chartSosmed->values())
        ->options([
            'backgroundColor'               => 'rgb(255, 99, 132, .5)',
            'borderColor'                   => 'rgb(255, 99, 132)',
            'fill'                          => true,
            'pointRadius'                   => 3.5,
            'pointBackgroundColor'          => 'transparent',
            'pointHoverBackgroundColor'     => 'rgb(255, 99, 132)',
        ]);
        $chart->dataset('PPOB', 'line', $chartPPOB->values())
        ->options([
            'backgroundColor'               => 'rgb(30, 227, 207, .4)',
            'borderColor'                   => 'rgb(30, 227, 207)',
            'fill'                          => true,
            'pointRadius'                   => 3.5,
            'pointBackgroundColor'          => 'transparent',
            'pointHoverBackgroundColor'     => 'rgb(30, 227, 207)',
        ]);

        /* $chart->options([
            'legend' =>
                [
                    'position' => 'top',
                    'labels' =>
                        [
                            'fontColor' => 'white', 'fontSize' => 16
                        ]
                ],
            'scales' => 
            [
                'xAxes' => 
                [
                    [
                        'ticks' => 
                        [
                            'fontColor' => 'white',
                            'backgroundColor' => 'white',
                            'fontSize' => 16
                        ]
                    ],
                ],
                'yAxes' => 
                [
                    [
                        'ticks' => 
                        [
                            "beginAtZero" => true,
                            'fontColor' => 'white',
                            'backgroundColor' => 'white',
                            'fontSize' => 16
                        ],
                    ]
                ],
            ],
        ]); */

        return $chart;

    }
}
