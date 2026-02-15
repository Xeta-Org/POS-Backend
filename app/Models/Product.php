<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'barcode';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'barcode',
        'product_name',
        'cost_price',
        'selling_price',
        'quantity',
        'minimum_stock',
    ];
}
