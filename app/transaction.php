<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $table = "transaction";

    public function transactionPPOB()
    {
        return $this->belongsTo('App\admin\trx\transactionPPOB', 'ppob_id');
    }

    public function transactionSosmed()
    {
        return $this->belongsTo('App\admin\trx\transactionSosmed', 'sosmed_id');
    }
}
