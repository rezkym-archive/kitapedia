<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class security_log extends Model
{
    /**
     * Table security_log
     */
    public $table = 'security_log';

    /**
     * Fillable
     */
    public $fillable = ['username', 'description', 'status', 'deleted_at'];
}
