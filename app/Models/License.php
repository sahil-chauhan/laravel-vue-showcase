<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Account;
use App\Models\Activation;



class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'license_key',
        'activation_limit',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function activations()
    {
        return $this->hasMany(Activation::class,'license_id','id');
    }


}
