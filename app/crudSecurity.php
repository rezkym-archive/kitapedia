<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\security_log;
use App\User;

class crudSecurity extends Model
{
    public static function isSecure($isRequest, $msg = '')
    {
        $userSession = auth()->user();
        if(!in_array($isRequest, $userSession->attributes))
        {
            /**
             * Suspend Account
             */
            $userAccount = User::find($userSession->id);
            $userAccount->status = 'suspended';
            $userAccount->save();

            /**
             * Insert Security Log
             */
            security_log::create([
                'username'      => $userSession->username,
                'description'   => $msg,
                'status'        => 'active'
            ]);

            /**
             * Logout user
             */
            auth()->logout();

            /**
             * Abort request
             */
            abort(501, 'Have an security reason, please try agian');

            

        }
    }
}
