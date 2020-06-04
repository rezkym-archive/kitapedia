<?php

namespace App\admin\trx;

use Illuminate\Database\Eloquent\Model;

class transactionPPOB extends Model
{
    protected $table = "transaction_ppob";
    
    /* public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function transactionSosmed() 
    {
        return $this->belongsTo('App\admin\trx\transactionSosmed', 'user_id');
    } */

}
