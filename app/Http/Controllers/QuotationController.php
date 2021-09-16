<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    public function quotation(){
        if (Auth::check()){
            return view('backend.quotation');

        }
        else{
            return redirect(url('login'));
        }
    }
}
