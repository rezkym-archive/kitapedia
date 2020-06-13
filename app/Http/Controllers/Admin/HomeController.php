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
     * Displays data to the admin main page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /**
         * Static Data
         * 
         * @return string
         */
        $username = auth()->user()->username;

        /**
         * User Data
         * 
         * @return array
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
         * 
         * @return array
         */
        $transactionStatus = self::allOrderStatus();
        $sosmedStatus = self::orderStatusProduct('sosmed');
        $ppobStatus = self::orderStatusProduct('ppob');
        
        /**
         * Chart transaction
         * 
         * @return array
         */
        $transactionChart = self::transactionChart();


        /**
         * Transaction
         * 
         * @return array
         */
        $transaction        = transaction::limit(4)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $transactionPPOB    = transactionPPOB::all();
        $transactionSosmed  = transactionSosmed::all();
        #dd($transaction[3]->transactionSosmed);
        

        /**
         * Return to admin home
         * 
         * @return array
         */
        return view('admin.home', 
        [
            'user'              => $dataUser,
            'transactionUser'   => $transaction,
            'totalSales'        => $totalSales,
            'trxStatus'         => array_merge($transactionStatus, $sosmedStatus, $ppobStatus),
            'transactionChart'  => $transactionChart,

        ]);

    }

    /**
     * Calculate product sales
     * 
     * PPOB
     * Sosmed
     * 
     * @return array
     */
    private function sales()
    {
        /**
         * Transaction PPOB
         * 
         * @return array
         */
        $countPPOB      = transactionPPOB::select('price')->sum('price');
        $countSosmed    = transactionSosmed::select('price')->sum('price');
        
        /**
         * Addition of both
         * 
         * @return integer
         */
        $countOfBoth = $countPPOB + $countSosmed;

        /**
         * Transform to array
         * 
         * @return array
         */
        $sales = 
        [
            'allSales'      => currencyIDR::beCalculated($countOfBoth),
            'ppobSales'     => currencyIDR::beCalculated($countPPOB),
            'sosmedSales'   => currencyIDR::beCalculated($countSosmed),
        ];

        /**
         * Print data
         * 
         * @return array
         */
        return $sales;

    }

    /**
     * Retrieve order status
     * 
     * @return array
     */
    private static function allOrderStatus()
    {
            /**
             * Sum Status PPOB and Sosmed
             * 
             * Success, pending, error
             * 
             * @return array
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
             * Return and print the results
             * 
             * @return array
             */
            return $transaction;

    }

    /**
     * Status Order per Product
     * 
     * @return array
     */
    private static function orderStatusProduct($type)
    {
        if($type == 'sosmed')
        {
            /**
             * Count data from database
             */
            $trxSosmed = DB::table('transaction_sosmed')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

            /**
             * Manipulation to arrays
             */
            $trxSosmed = [$trxSosmed];

            /**
             * Return in an array state
             * 
             * @return array
             */
            return $trxSosmed;

        } else if($type == 'ppob')
        {
            /**
             * Count data from database
             */
            $trxPPOB = DB::table('transaction_ppob')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

            /**
             * Manipulation to arrays
             */
            $trxPPOB = [$trxPPOB];

            /**
             * Return in an array state
             * 
             * @return array
             */
            return $trxPPOB;

        }

        /**
         * Returns an error of 500 if no type is found
         */
        abort(500, 'ADM-HM-C:abort_status_product');
    }

    /**
     * Sales chart
     * 
     * @return array
     */
    private static function transactionChart()
    {
        /**
         * Must be an array
         * 
         * @return x
         */
        $chartSosmed    = collect([]); 
        $chartPPOB      = collect([]); 
        $datetimeChange = collect([]); 

        /**
         * Take data and sort the date from the previous 7 days
         * 
         * @return array
         */
        for ($days_backwards = 7; $days_backwards >= 0; $days_backwards--) 
        {
            /**
             * Sosmed Chart variable
             * 
             * @return array
             */
            $chartSosmed->push(transaction::whereDate('created_at', Carbon::tomorrow()->subDays($days_backwards))
            ->where('type', 'sosmed')
            ->count());

            /**
             * PPOB Chart variable
             * 
             * @return array
             */
            $chartPPOB->push(transaction::whereDate('created_at', Carbon::tomorrow()->subDays($days_backwards))
            ->where('type', 'ppob')
            ->count());

            /**
             * Change the datetime format
             * 
             * @return array
             */
            $datetimeChange->push(Carbon::tomorrow()->subDays($days_backwards)->format('d-m'));

        }
    
        /* Set transactionChart class */
        $chart = new transactionChart;

        /**
         * Set labels for chart
         * 
         * @return array
         */
        $chart->labels($datetimeChange);

        /**
         * Set the first data
         * 
         * @return array
         */
        $chart->dataset('Sosmed', 'line', $chartSosmed->values())
        ->options([
            'backgroundColor'               => 'rgb(255, 99, 132, .5)',
            'borderColor'                   => 'rgb(255, 99, 132)',
            'fill'                          => true,
            'pointRadius'                   => 3.5,
            'pointBackgroundColor'          => 'transparent',
            'pointHoverBackgroundColor'     => 'rgb(255, 99, 132)',
        ]);

        /**
         * Set the second data
         * 
         * @return array
         */
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

        /**
         * Print chart
         * 
         * @return array
         */
        return $chart;

    }
}
