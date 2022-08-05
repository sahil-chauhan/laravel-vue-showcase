<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Account;
use App\Models\AccountUser;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'access_level',
        'is_admin',
        'is_superadmin',
        'password',
        'oauth_id',
        'oauth_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function list_user_role_users()
    {
        $auth_user = auth()->user();
        
        if( $auth_user->is_superadmin )
        {
            return static::where('id','!=',$auth_user->id)->paginate(config('site.paginate_results_count'));
        }
        
        return static::where([ 'is_admin' => 0 , 'is_superadmin' => 0 ])->paginate(config('site.paginate_results_count'));
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class,AccountUser::class,'user_id','account_id');
    }

    public function auth_user_get_token()
    {
        $user = auth()->user();        
        if( $user->tokens->count() )
        {
            $token = $user->tokens[0]->token;
        }else{
            $tokenObj = $user->createToken('Ai Auth SPA Token');
            $token = $tokenObj->plainTextToken;
        }
        return $token;
    }
}
