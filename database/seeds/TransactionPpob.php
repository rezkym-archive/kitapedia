<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionPpob extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_ppob')->insert([

            [
                'tid'           => 'ijklow',
                'ppob_id'       => '1',
                'username'      => 'rezky',
                'service'       => 'Telkomsel 1.000',
                'target'        => '08123456789',
                'price'         => 2000,
                'note'          => 'Pesanan sedang di proses',
                'status'        => 'pending',
                'refund'        => 'no',
                'place'         => 'WEB',
                'provider'      => 'GazzPay',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            
            ],
            [
                'tid'           => 'ijklow',
                'ppob_id'       => '2',
                'username'      => 'rezky',
                'service'       => 'Telkomsel 1.000',
                'target'        => '08123456789',
                'price'         => 2000,
                'note'          => 'Pesanan sedang di proses',
                'status'        => 'success',
                'refund'        => 'no',
                'place'         => 'WEB',
                'provider'      => 'GazzPay',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            
            ],
            [
                'tid'           => 'ijklow',
                'ppob_id'       => '3',
                'username'      => 'rezky',
                'service'       => 'Telkomsel 1.000',
                'target'        => '08123456789',
                'price'         => 2000,
                'note'          => 'Pesanan sedang di proses',
                'status'        => 'error',
                'refund'        => 'no',
                'place'         => 'WEB',
                'provider'      => 'GazzPay',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            
            ],
        ]);
    }
}
