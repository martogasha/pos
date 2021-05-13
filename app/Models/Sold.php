<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',
        'name',
        'price',
        'quantity',
        'total',
        'profit',
        'image',
        'payment_method',
        'user_id',
        'date',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
