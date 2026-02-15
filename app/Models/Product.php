<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'barcode',
        'product_name',
        'cost_price',
        'selling_price',
        'quantity',
    ];
}
