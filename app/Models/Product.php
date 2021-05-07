<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_desc',
        'product_barcode',
        'buying_price',
        'selling_price',
        'product_quantity',
        'product_image',
        'quantity_of_pack',
        'number_of_pack',
    ];
}
