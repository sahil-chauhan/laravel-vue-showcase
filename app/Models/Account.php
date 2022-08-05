<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AccountUser;
use App\Models\UserAccessLevel;
use App\Models\License;


class Account extends Model
{
    use HasFactory;

    public function users()
	{	
		return $this->belongsToMany(User::class,AccountUser::class, 'account_id', 'user_id');
	}

	public function licenses()
    {
        return $this->hasMany(License::class,'account_id','id');
    }

}
