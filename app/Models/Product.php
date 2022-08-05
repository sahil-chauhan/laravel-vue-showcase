<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\License;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
		'sku',
		'price',
		'sale_price'
    ];

    public function licenses()
    {
        return $this->hasMany(License::class,'product_id','id');
    }

}
