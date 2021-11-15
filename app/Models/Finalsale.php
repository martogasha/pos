<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finalsale extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',
        'name',
        'price',
        'quantity',
        'total',
        'date',
        'phone',
        'phoneNumber',
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
