<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction')->insert([
            
            [
                'user_id'   => '1',
                'ppob_id'   => '1',
                'sosmed_id' => null,
                'username'  =>'demo',
                'type'      => 'ppob',
                'status'    => 'pending',
                'created_at'    => Carbon::today()
            ],
            [
                'user_id'   => '1',
                'ppob_id'   => '1',
                'sosmed_id' => null,
                'username'  =>'demo',
                'type'      => 'ppob',
                'status'    => 'pending',
                'created_at'    => Carbon::today()
            ],
            [
                'user_id'   => '1',
                'ppob_id'   => '1',
                'sosmed_id' => null,
                'username'  =>'demo',
                'type'      => 'ppob',
                'status'    => 'pending',
                'created_at'    => Carbon::today()
            ],
            [
                'user_id'   => '2',
                'ppob_id'   => '2',
                'sosmed_id' => null,
                'username'  =>'demo',
                'type'      => 'ppob',
                'status'    => 'pending',
                'created_at'    => Carbon::today()
            ],
            [
                'user_id'   => '1',
                'ppob_id'   => '3',
                'sosmed_id' => null,
                'username'  =>'demo',
                'type'      => 'ppob',
                'status'    => 'pending',
                'created_at'    => Carbon::today()
            ],
            [
                'user_id'   => '1',
                'ppob_id'   => null,
                'sosmed_id' => '1',
                'username'  =>'rezky',
                'type'      => 'sosmed',
                'status'    => 'pending',
                'created_at'    => Carbon::today()
            ],
            [
                'user_id'   => '2',
                'ppob_id'   => null,
                'sosmed_id' => '2',
                'username'  =>'rezky',
                'type'      => 'sosmed',
                'status'    => 'pending',
                'created_at'    => Carbon::today()
            ],
            [
                'user_id'   => '2',
                'ppob_id'   => null,
                'sosmed_id' => '3',
                'username'  =>'rezky',
                'type'      => 'sosmed',
                'status'    => 'pending',
                'created_at'    => Carbon::today()
            ],

        ]);
    }
}
