<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
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
        'total_for_services',
        'profit_of_services',
        'user_id',
        'payment_method',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
