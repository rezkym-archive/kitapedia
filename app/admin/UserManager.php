<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserManager extends Model
{
    /** Set Soft Deletes */
    use SoftDeletes;

    /**
     * The attributes that are table
     *
     * @var string
     */
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'email', 'nohp', 'password', 'balance', 'status', 'role', 'created_at'];

    /**
     * The attributes that are softdeletes
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
