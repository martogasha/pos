<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function quotation(){
        return view('backend.quotation');
    }
}
