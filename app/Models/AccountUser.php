<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
		'user_id',
		'access_level'
    ];

    public static function addUserToAccount($user_id,$account_id,$access_level)
    {
    	self::create([
    		'account_id' => $account_id,
    		'user_id' => $user_id,
    		'access_level' => $access_level,
    	]);
    }

    public static function removeUserFromAccount($user_id)
    {
        $account_user = self::where(['user_id' => $user_id ])->first();
        if( $account_user )
        {
            $account_user->delete();
        }
    }

    public static function removeAccountFromUser($account_id)
    {
        $account_user = self::where(['account_id' => $account_id ])->first();
        if( $account_user )
        {
            $account_user->delete();
        }
    }

}
