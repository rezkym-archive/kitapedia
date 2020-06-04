<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class TransactionSosmed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_sosmed')->insert([
            [
                'tid'           => 'uvwksla',
                'sosmed_id'     => '1',
                'username'      => 'demo',
                'service'       => 'Instagram Followers [ MAX 15K ] [ NO REFILL ] Instant',
                'type'          => 'instagram-followers',
                'target'        => '@demo',
                'qty'           => 4000,
                'count'         => 3500,
                'remain'        => 500,
                'price'         => 10000,
                'reff'          => '0',
                'status'        => 'pending',
                'refund'        => 'no',
                'place'         => 'WEB',
                'provider'      => 'GazzPay',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'tid'           => 'uvwksla',
                'sosmed_id'     => '2',
                'username'      => 'demo',
                'service'       => 'Instagram Followers [ MAX 15K ] [ NO REFILL ] Instant',
                'type'          => 'instagram-followers',
                'target'        => '@demo',
                'qty'           => 4000,
                'count'         => 3500,
                'remain'        => 500,
                'price'         => 10000,
                'reff'          => '0',
                'status'        => 'success',
                'refund'        => 'no',
                'place'         => 'WEB',
                'provider'      => 'GazzPay',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'tid'           => 'uvwksla',
                'sosmed_id'     => '3',
                'username'      => 'demo',
                'service'       => 'Instagram Followers [ MAX 15K ] [ NO REFILL ] Instant',
                'type'          => 'instagram-followers',
                'target'        => '@demo',
                'qty'           => 4000,
                'count'         => 3500,
                'remain'        => 500,
                'price'         => 10000,
                'reff'          => '0',
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
